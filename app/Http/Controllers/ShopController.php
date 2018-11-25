<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Type;
use App\Model\Size;
use App\Model\ProductGallery;
use App\Model\ProductStock;
use App\Model\ProductTag;
use App\Model\Tag;
use App\Model\Cart;
use App\Model\UserAddress;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Helpers\RajaOngkir;
use App\Helpers\MidtransHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
use Exception;
use Auth;

class ShopController extends Controller
{
    public function index(Request $request, $slug) 
    {
        $category = Category::where('_slug', '=', $slug)->first();
        $category_parent = Category::where('id', '=', $category->parent_category_id)->first();
        
        $products_query = Product::query();
        if($request->genderIndex != null){
            $products_query = $products_query->whereIn('gender_allocation_id', $request->genderIndex);
        }
        if($request->sizeIndex != null){
            $products_query = $products_query->whereHas('productStocks', function ($query) use ($request){
                                $query->whereIn('size_id', $request->sizeIndex);
                            });
        }
        if($category->id != null){
            $products_query = $products_query->where('category_id', '=', $category->id);
        }
        if($request->priceFrom != null){
            $priceFrom = $request->priceFrom;
            $products_query = $products_query->where('_price', '>=', $request->priceFrom);
        }
        if($request->priceTo != null){
            $priceTo = $request->priceTo;
            $products_query = $products_query->where('_price', '<=', $request->priceTo);
        }
        $products = $products_query->paginate(2);

        $tags = $this->getAllTags();
        $genders = Type::where('category_id', '=', 11)->get();
        $genders_selected = $request->genderIndex;
        $sizes_selected = $request->sizeIndex;
        $sizes = Size::where('_active', '=', "1")->get();
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('shop.index')->with(compact('products', 'category', 'genders', 'sizes', 'category_parent', 'cmsUrl', 'tags', 'genders_selected', 'priceFrom', 'priceTo', 'sizes_selected'));
    } 

    public function indexByTag(Request $request, $id) 
    {   
        $params = explode('+', $id);
        $tag_name = $params[1];
        $product_tag = explode('-', $params[0]);        
        $query_tag = ProductTag::select('product_id');

        if($product_tag[0] == 'club') {
            $query_tag = $query_tag->where('club_id', '=', $product_tag[1]);
        } else if($product_tag[0] == 'league') {
            $query_tag = $query_tag->where('league_id', '=', $product_tag[1]);
        } else if($product_tag[0] == 'sleeve') {
            $query_tag = $query_tag->where('sleeve_id', '=', $product_tag[1]);
        } else if($product_tag[0] == 'player') {
            $query_tag = $query_tag->where('player_id', '=', $product_tag[1]);
        }

        $query_tag = $query_tag->where('deleted_at', '=', null);
        $id_product =$query_tag->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $id_product)->paginate(2);

        $tags = $this->getAllTags();
        $genders = Type::where('category_id', '=', 11)->get();
        $sizes = Size::where('_active', '=', "1")->get();
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('shop.index-by-tag')->with(compact('products', 'genders', 'sizes', 'cmsUrl', 'tag_name', 'tags'));
    }

    public function detail(Request $request, $slug)
    {   
        $product = Product::where('_slug', '=', $slug)->first();
        $category = Category::where('id', '=', $product->category_id)->first();
        $category_parent = Category::where('id', '=', $category->parent_category_id)->first();
        $products_sizes = ProductStock::where('product_id', '=', $product->id)->get();
        $products_galleries = ProductGallery::where('product_id', '=', $product->id)->get();
        $product_tags = $this->getTagsSelected($product->id);
        $related_products =  Product::where('category_id', '=' , $product->category_id)->limit(4)->get();
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");

            $session_counter_view_product = "counter_view_product-". $product->id;
            if (!\Session::has($session_counter_view_product)) {
            $product->_count_view = $product->_count_view + 1;
            $product->save();
            \Session::put($session_counter_view_product, "");
        }

        return view('shop.detail')
            ->with(compact('product', 
                           'category', 
                           'category_parent', 
                           'cmsUrl', 
                           'products_sizes', 
                           'products_galleries',
                           'product_tags',
                           'related_products'));
    }

    public function checkout(Request $request)
    {
        // check if exist in current order
        // only reload if exist
        // create new if not exist
        // delete this session's shopping cart
        // prepare order data to be returned
        // cut quantity
        $order = new Order();
        $shippingCost = -1;

        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $cart = \Session::get($session_list_cart_user);
        $cart = $cart[0];

        $currentOrder = Order::query()
        ->where('cart_no', \Session::get($session_user_cart))
        ->first();

        if(isset($cart) && !$currentOrder){
            $orderId = DB::select("select nextseq('fe_tx_order','') as id FROM DUAL;");
            $order->id = $orderId[0]->id;
            $order->cart_no =$cart[0]->cart_no;
            $order->user_id = Auth::user()->id;
            $order->_email = Auth::user()->_email;
            $order->freight_provider_id = 'FREIGHTPROVIDER01';

            $defaultAddress = UserAddress::query()
                ->where('_default', '1')
                ->where('user_id', Auth::user()->id)
                ->first();
            if($defaultAddress){
                $order->user_address_id = $defaultAddress->id;
                $order->_address = $defaultAddress->_address;
                $order->_receiver_name = $defaultAddress->_receiver_name;
                $order->_receiver_phone = $defaultAddress->_receiver_phone;
                $order->ro_city_id = $defaultAddress->ro_city_id;
                $order->ro_province_id = $defaultAddress->ro_province_id;
                $order->_kota = $defaultAddress->_kota;
                $order->_kelurahan = $defaultAddress->_kelurahan;
                $order->_kecamatan = $defaultAddress->_kecamatan;
                $order->_kode_pos = $defaultAddress->_kode_pos;
                $shippingCost = $this->getCost($order->ro_city_id, 'tiki', 1700);
                dd($shippingCost);
            }
            $idx = 0;
            $orderItems = array();
            foreach($cart as $item){
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->cart_id = $item->id;
                $detail->product_id = $item->product_id;
                $detail->product_stock_id = $item->product_stock_id;
                $detail->_qty = $item->_qty;
                $detail->_note = $item->_note;
                $detail->product_name = $item->products->_name;
                $detail->product_image_url = $item->products->_image_url;
                $detail->product_price = $item->products->_price;
                $detail->product_packaging_price = $item->products->_packaging_price;
                $detail->product_weight = $item->products->_weight;
                $orderItems[$idx] = $detail;
                $idx++;
            }
            dd($orderItems);
        } else {
            // dd(0);
        }

        if (!$currentOrder) {

        } else{
            // $currentOrder->_qty = $currentOrder->_qty + $request->quantity;
            // $currentOrder->save();            
        }


        $province = RajaOngkir::getProvince();
        
        $order_detail = array(
            "customer_name" => "puspo",
            "customer_email" => "puspo@team-company.asia",
            "customer_phone" => "082231782659",
            "order_id" => rand(),
            "amount" => 10000,
        );

        $token = MidtransHelper::purchase($order_detail);
        

        return view('shop.checkout', compact('token'));
    }

    public function checkoutGuest(Request $request)
    {
        $province = RajaOngkir::getProvince();
        
        $order_detail = array(
            "customer_name" => "puspo",
            "customer_email" => "puspo@team-company.asia",
            "customer_phone" => "082231782659",
            "order_id" => rand(),
            "amount" => 10000,
        );

        $token = MidtransHelper::purchase($order_detail);
        // $orderId = DB::select("select nextseq('fe_tx_order','') FROM DUAL;");
        return view('shop.checkout_guest', compact('token'));
    }

    public function cart(){
        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $cart = \Session::get($session_list_cart_user);
        $cart = $cart[0];
        return view('shop.cart')->with(compact('cart'));
    }

    public function getCity(Request $request){
        $param = array();
        if(isset($request->province)) {
            $param['province'] = $request->province;
        }
        return RajaOngkir::getCity($param);
    }

    public function calculateCost(Request $request){
        $formParam = array();
        $formParam['origin'] = 153;
        $formParam['destination'] = $request->destination;
        $formParam['courier'] = $request->courier;
        $formParam['weight'] = $request->weight;
        return RajaOngkir::calculateCost($formParam);
    }

    public function getCost($destination, $courier, $weight){
        $formParam = array();
        $formParam['origin'] = 153;
        $formParam['destination'] = $destination;
        $formParam['courier'] = $courier;
        $formParam['weight'] = $weight;
        return RajaOngkir::calculateCost($formParam);
    }    

    public function newToken(Request $request){
        $order_detail = array(
            "customer_name" => "puspo",
            "customer_email" => "puspo@team-company.asia",
            "customer_phone" => "082231782659",
            "order_id" => rand(),
            "amount" => $request->amount,
        );
        $token = MidtransHelper::purchase($order_detail);
        return $token;
    }

    public function addToCart(Request $request, $product_id)
    {
        $product_stock = ProductStock::where('product_id', '=', $product_id)->where('size_id', '=', $request->size_id)->first();
        if($product_stock->_stock < $request->quantity){
            throw new Exception("Stock is not available. Quantity max is ". $product_stock->_stock);
        } else {
            $session_user_cart = "user_cart";
            if (!\Session::has($session_user_cart)) {
                \Session::put($session_user_cart, uniqid());            
            }

            $currentData = Cart::query()
                ->where('cart_no', \Session::get($session_user_cart))
                ->where('product_stock_id', $product_stock->id)
                ->first();
            if ($currentData) {
                $currentData->_qty = $currentData->_qty + $request->quantity;
                $currentData->save();
            } else {
                $cart = new Cart();
                $cart->cart_no = \Session::get($session_user_cart);
                $cart->product_id = $product_id;
                $cart->product_stock_id = $product_stock->id;
                $cart->_qty = $request->quantity;
                $cart->created_at = Carbon::now();
                if(Auth::guest()){
                    $session_guest_no = "guest_no";
                    if (!\Session::has($session_guest_no)) {
                        \Session::put($session_guest_no, uniqid());
                    }
                    $cart->guest_no = \Session::get($session_guest_no);
                } else {
                    $cart->user_no = Auth::user()->id;
                }
                $cart->save();
            }
            // $product_stock->_stock = $product_stock->_stock - $request->quantity;
            // $product_stock->save();

            $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
            $list_cart_user = Cart::where('cart_no', '=', \Session::get($session_user_cart))->get();
            
            \Session::forget($session_list_cart_user);
            \Session::push($session_list_cart_user, $list_cart_user);
        }
    }

    private function getTagsSelected($id)
    {   
        $sleeves = ProductTag::join('cms_tm_sleeve','cms_tm_product_tag.sleeve_id','cms_tm_sleeve.id')
            ->select(
                      'cms_tm_sleeve.id',
                      'cms_tm_sleeve._name'
              )
            ->where('cms_tm_product_tag.product_id', '=' , $id)
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->get();

        $leagues = ProductTag::join('cms_tm_league','cms_tm_product_tag.league_id','cms_tm_league.id')
            ->select(
                      'cms_tm_league.id',
                      'cms_tm_league._name'
              )
            ->where('cms_tm_product_tag.product_id', '=' , $id)
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->get();

        $clubs = ProductTag::join('cms_tm_club','cms_tm_product_tag.club_id','cms_tm_club.id')
            ->select(
                      'cms_tm_club.id',
                      'cms_tm_club._name'
              )
            ->where('cms_tm_product_tag.product_id', '=' , $id)
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->get();

        $players = ProductTag::join('cms_tm_player','cms_tm_product_tag.player_id','cms_tm_player.id')
            ->select(
                      'cms_tm_player.id',
                      'cms_tm_player._name'
              )
            ->where('cms_tm_product_tag.product_id', '=' , $id)
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->get();
                                                
        $arr_tags[] = new Tag();

        $index = 0;
        foreach ($clubs as $club) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "club-".$club->id;
            $arr_tags[$index]->name = "club - ".$club->_name;
            $index++;            
        }

        foreach ($leagues as $league) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "league-".$league->id;
            $arr_tags[$index]->name = "league - ".$league->_name;
            $index++;            
        }

        foreach ($sleeves as $sleeve) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "sleeve-".$sleeve->id;
            $arr_tags[$index]->name = "sleeve - ".$sleeve->_name;
            $index++;            
        } 

        foreach ($players as $player) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "player-".$player->id;
            $arr_tags[$index]->name = "player - ".$player->_name;
            $index++;            
        } 
        return $arr_tags;
    }

    private function getAllTags()
    {   
        $sleeves = ProductTag::join('cms_tm_sleeve','cms_tm_product_tag.sleeve_id','cms_tm_sleeve.id')
            ->select(
                      'cms_tm_sleeve.id',
                      'cms_tm_sleeve._name'
              )
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->distinct('cms_tm_sleeve.id')
            ->get();

        $leagues = ProductTag::join('cms_tm_league','cms_tm_product_tag.league_id','cms_tm_league.id')
            ->select(
                      'cms_tm_league.id',
                      'cms_tm_league._name'
              )
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->distinct('cms_tm_league.id')
            ->get();
        $clubs = ProductTag::join('cms_tm_club','cms_tm_product_tag.club_id','cms_tm_club.id')
            ->select(
                      'cms_tm_club.id',
                      'cms_tm_club._name'
              )
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->distinct('cms_tm_club.id')
            ->get();

        $players = ProductTag::join('cms_tm_player','cms_tm_product_tag.player_id','cms_tm_player.id')
            ->select(
                      'cms_tm_player.id',
                      'cms_tm_player._name'
              )
            ->where('cms_tm_product_tag.deleted_at', '=' , null)
            ->distinct('cms_tm_player.id')
            ->get();
                                                
        $arr_tags[] = new Tag();

        $index = 0;
        foreach ($clubs as $club) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "club-".$club->id;
            $arr_tags[$index]->name = "club - ".$club->_name;
            $index++;            
        }

        foreach ($leagues as $league) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "league-".$league->id;
            $arr_tags[$index]->name = "league - ".$league->_name;
            $index++;            
        }

        foreach ($sleeves as $sleeve) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "sleeve-".$sleeve->id;
            $arr_tags[$index]->name = "sleeve - ".$sleeve->_name;
            $index++;            
        } 

        foreach ($players as $player) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "player-".$player->id;
            $arr_tags[$index]->name = "player - ".$player->_name;
            $index++;            
        } 
        return $arr_tags;
    }    
}
