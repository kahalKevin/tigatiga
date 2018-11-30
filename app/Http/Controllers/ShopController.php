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
use Redirect;

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

    public function indexSearch(Request $request) 
    {
        $keyword = $request->searchItem;
        $products_query = Product::query();
        $products_query = $products_query->where('_name','LIKE', '%'.$keyword.'%');
        if($request->genderIndex != null){
            $products_query = $products_query->whereIn('gender_allocation_id', $request->genderIndex);
        }
        if($request->sizeIndex != null){
            $products_query = $products_query->whereHas('productStocks', function ($query) use ($request){
                                $query->whereIn('size_id', $request->sizeIndex);
                            });
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
        return view('shop.index-search')->with(compact('products', 'keyword', 'genders', 'sizes', 'cmsUrl', 'tags', 'genders_selected', 'priceFrom', 'priceTo', 'sizes_selected'));
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

    public function checkoutGuest(Request $request)
    {
        $order = new Order();
        $orderItems = array();
        $shippingDetail = -1;
        $defaultAddress = -1;

        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $cart = \Session::get($session_list_cart_user);
        if(isset($cart) && 0 == $cart[0]->count()){
            return redirect('/')->with('error', 'Your session cart is expired');
        }

        $cart = $cart[0];
        $key = \Session::get($session_user_cart);
        if(isset($request->order_id)){
            $key = $request->order_id;
        }
        $currentOrder = Order::query()
            ->where('cart_no', $key)
            ->first();

        if(isset($cart) && !$currentOrder){
            $errorMessage = $this->validateProductStock($cart);
            if($errorMessage!=""){
                return redirect::back()->with('error', $errorMessage);
            }
            $totalOrder = $this->totalPriceAndWeight($cart);
            $orderId = DB::select("select nextseq('fe_tx_order','') as id FROM DUAL;");
            $order->id = $orderId[0]->id;
            $order->cart_no =$cart[0]->cart_no;
            $order->_total_amount = $totalOrder['price'];
            $order->_grand_total = $totalOrder['price'];
            $order->status_id = 'STATUSORDER0';
            $order->guest_no = \Session::get($session_user_cart);
            $order->_email = "";
            $order->freight_provider_id = 'FREIGHTPROVIDER01';
            $order->_address = "";
            $order->_receiver_name = "";
            $order->_receiver_phone = "";
            $order->_kota = "";
            $order->_kode_pos = "";            

            if(!empty($order->ro_city_id)){
                $shippingDetail = $this->getCost($order->ro_city_id, 'jne', $totalOrder['weight']);
            }

            $order->save();

            $idx = 0;       

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
                $detail->product_fixed_price = $item->products->_price;
                $detail->product_packaging_price = $item->products->_packaging_price;
                $detail->product_weight = $item->products->_weight;
                $orderItems[$idx] = $detail;
                $detail->save();
                $idx++;

                $product_stock = ProductStock::query()
                    ->where('product_id', $item->product_id)
                    ->where('size_id', $item->productStocks->size_id)
                    ->first();
                $product_stock->_stock = $product_stock->_stock - $item->_qty;
                $product_stock->save();
            }
            Cart::where('cart_no', '=', $order->cart_no)->delete();
            \Session::forget($session_list_cart_user);
        } else {
            $order = $currentOrder;
            $orderItems = OrderDetail::query()
                ->where('order_id', $order->id)
                ->get();
            $totalOrder = $this->totalPriceAndWeight($orderItems);

            if(!empty($order->ro_city_id)){
                $shippingDetail = $this->getCost($order->ro_city_id, 'jne', $totalOrder['weight']);
            }
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
        return view('shop.checkout_guest', compact('token', 'shippingDetail', 'order', 'orderItems', 'defaultAddress', 'province', 'totalOrder'));
    }

    public function checkout(Request $request)
    {
        $order = new Order();
        $orderItems = array();
        $shippingDetail = -1;
        $defaultAddress = -1;

        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $cart = \Session::get($session_list_cart_user);
        if(isset($cart) && 0 == $cart[0]->count()){
            return redirect('/')->with('error', 'Your session cart is expired');
        }

        $cart = $cart[0];
        $key = \Session::get($session_user_cart);
        if(isset($request->order_id)){
            $key = $request->order_id;
        }
        $currentOrder = Order::query()
            ->where('cart_no', $key)
            ->where('status_id', 'STATUSORDER0')
            ->first();

        if(isset($cart) && !$currentOrder){
            $errorMessage = $this->validateProductStock($cart);
            if($errorMessage!=""){
                return redirect::back()->with('error', $errorMessage);
            }
            $totalOrder = $this->totalPriceAndWeight($cart);
            $orderId = DB::select("select nextseq('fe_tx_order','') as id FROM DUAL;");
            $order->id = $orderId[0]->id;
            $order->cart_no =$cart[0]->cart_no;
            $order->_total_amount = $totalOrder['price'];
            $order->_grand_total = $totalOrder['price'];
            $order->status_id = 'STATUSORDER0';
            $order->user_id = Auth::user()->id;
            $order->_email = Auth::user()->_email;
            $order->freight_provider_id = 'FREIGHTPROVIDER01';
            $order->_address = "";
            $order->_receiver_name = "";
            $order->_receiver_phone = "";
            $order->_kota = "";
            $order->_kode_pos = "";            

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
                $shippingDetail = $this->getCost($order->ro_city_id, 'jne', $totalOrder['weight']);
            }

            $order->save();

            $idx = 0;       

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
                $detail->product_fixed_price = $item->products->_price;
                $detail->product_packaging_price = $item->products->_packaging_price;
                $detail->product_weight = $item->products->_weight;
                $orderItems[$idx] = $detail;
                $detail->save();
                $idx++;

                $product_stock = ProductStock::query()
                    ->where('product_id', $item->product_id)
                    ->where('size_id', $item->productStocks->size_id)
                    ->first();
                $product_stock->_stock = $product_stock->_stock - $item->_qty;
                $product_stock->save();
            }
            Cart::where('cart_no', '=', $order->cart_no)->delete();
            \Session::forget($session_list_cart_user);
        } else if($currentOrder) {
            $order = $currentOrder;
            $orderItems = OrderDetail::query()
                ->where('order_id', $order->id)
                ->get();
            $totalOrder = $this->totalPriceAndWeight($orderItems);
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
                $order->save();
                $shippingDetail = $this->getCost($order->ro_city_id, 'jne', $totalOrder['weight']);
            }
        } else {
            return redirect('/')->with('error', 'Your session cart is expired');
        }

        $province = RajaOngkir::getProvince();

        $list_user_address = UserAddress::where('user_id', '=', Auth::user()->id)->get();

        return view('shop.checkout', compact('shippingDetail', 'order', 'orderItems', 'defaultAddress', 'province', 'totalOrder', 'list_user_address'));
    }

    private function validateProductStock($cart){
        $errorMessage = "";
        foreach($cart as $item){
            $product_stock = ProductStock::query()
                ->where('product_id', $item->product_id)
                ->where('size_id', $item->productStocks->size_id)
                ->first();
            if($product_stock->_stock < $item->_qty){
                $errorMessage = "Stock is not available. Quantity max is ". $product_stock->_stock;
                break;
            }
        }
        return $errorMessage;
    }

    private function totalPriceAndWeight($cart){
        $result = array();
        $price = 0;
        $weight = 0;
        foreach ($cart as $item) {
            $price += $item->_qty * $item->products->_price;
            $weight += $item->_qty * $item->products->_weight;
        }
        $result['price'] = $price;
        $result['weight'] = $weight;
        return $result;
    }

    public function cart(){
        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $cart = \Session::get($session_list_cart_user);
        if($cart == null){
            return redirect('/')->with('error', 'Your session cart is expired');
        }
        $cart = $cart[0];
        $cart = $this->syncSessionCartToProductStock($cart);
        \Session::forget($session_list_cart_user);
        \Session::push($session_list_cart_user, $cart);
        return view('shop.cart')->with(compact('cart'));
    }

    public function syncSessionCartToProductStock($cart){
        $cart_sycn = collect();
        foreach ($cart as $cart_item) {

            $product_stock = ProductStock::where('product_id', '=', $cart_item->product_id)->where('id', '=', $cart_item->product_stock_id)->first();
            if($product_stock->_stock >= $cart_item->_qty){
                $cart_sycn->push($cart_item);
            } else {
                Cart::where('cart_no', $cart_item->cart_no)
                    ->where('product_stock_id', $product_stock->id)
                    ->delete();
            }
        }
        return $cart_sycn;
    }

    public function increaseStockCart($id){
        $cart = Cart::where('id', '=', $id)->first();
        $product_stock = ProductStock::where('product_id', '=', $cart->product_id)->where('id', '=', $cart->product_stock_id)->first();
        
        if($product_stock->_stock < $cart->_qty + 1){
            return Redirect::back()->with('error','Max quantity is '.$product_stock->_stock);
        }
        $cart->_qty = $cart->_qty + 1;
        $cart->save();

        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $list_cart_user = Cart::where('cart_no', '=', \Session::get($session_user_cart))->get();
        
        \Session::forget($session_list_cart_user);
        \Session::push($session_list_cart_user, $list_cart_user);        
        return Redirect::back();
    }

    public function decreaseStockCart($id){
        $cart = Cart::where('id', '=', $id)->first();
        if($cart->_qty <= 1){
            return Redirect::back()->with('error','Min quantity is 0');
        }
        $cart->_qty = $cart->_qty - 1;
        $cart->save();

        $session_user_cart = "user_cart";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        $list_cart_user = Cart::where('cart_no', '=', \Session::get($session_user_cart))->get();
        
        \Session::forget($session_list_cart_user);
        \Session::push($session_list_cart_user, $list_cart_user);        
        return Redirect::back();
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
        $currentOrder = Order::query()
            ->where('id', $request->orderId)
            ->where('status_id', 'STATUSORDER0')
            ->first();
        $grandTotal = $currentOrder->_total_amount + $request->shipping;
        $order_detail = array(
            "customer_name" => $currentOrder->_receiver_name,
            "customer_email" => $currentOrder->_email,
            "customer_phone" => $currentOrder->_receiver_phone,
            "order_id" => $currentOrder->id,
            "amount" => $grandTotal,
        );
        $token = MidtransHelper::purchase($order_detail);
        $currentOrder->_freight_amount = $request->shipping;
        $currentOrder->_grand_total = $grandTotal;
        $currentOrder->save();
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
            } else {
                $key = \Session::get($session_user_cart);
                $savedOrder = Order::query()
                    ->where('cart_no', $key)
                    ->first();
                if($savedOrder){
                    \Session::put($session_user_cart, uniqid());
                }
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

            $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
            $list_cart_user = Cart::where('cart_no', '=', \Session::get($session_user_cart))->get();
            
            \Session::forget($session_list_cart_user);
            \Session::push($session_list_cart_user, $list_cart_user);
        }
    }

    public function addNewAddress(Request $request)
    {
        $user_address = new UserAddress();
        $user_address->user_id = Auth::user()->id;
        $user_address->_address = $request->address;

        $counter_default_address = UserAddress::where('user_id', '=', Auth::user()->id)->where('_default', '=', '1')->count();
        if($counter_default_address = 0){
            $user_address->_default = '1';            
        } else {
            $user_address->_default = '0';
        }

        $user_address->_title = "Rumah";
        $user_address->_receiver_name = $request->receiver_name;
        $user_address->_receiver_phone = $request->phone;
        $user_address->ro_city_id = $request->city;
        $user_address->ro_province_id = $request->provinsi;
        $user_address->_kota = $request->city;
        $user_address->_kode_pos = $request->postal_code;
        $user_address->_active = '1';
        $user_address->created_at = Carbon::now();
        $user_address->save();

        return Redirect::to('shop/checkout')->with('order_id', $request->order_id);
    }

    public function addNewAddressGuest(Request $request)
    {
        $order = Order::where('id', '=', $request->order_id)->first();
        $order->_address = $request->address;
        $order->_email = $request->email;
        $order->_receiver_name = $request->receiver_name;
        $order->_receiver_phone = $request->phone;
        $order->ro_city_id = $request->city;
        $order->ro_province_id = $request->provinsi;
        $order->_kode_pos = $request->postal_code;
        $order->save();

        return Redirect::to('shop/checkoutGuest')->with('order_id', $request->order_id);
    } 

    public function setDefaultAddress(Request $request)
    {
        //set all default to 0
        UserAddress::where('user_id', '=', Auth::user()->id)->update(['_default'=>'0']);
        $user_address = UserAddress::where('id', '=', $request->address)->first();
        $user_address->_default = '1';
        $user_address->save();
        return Redirect::to('shop/checkout')->with('order_id', $request->order_id);
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
            $arr_tags[$index]->name = $club->_name;
            $index++;            
        }

        foreach ($leagues as $league) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "league-".$league->id;
            $arr_tags[$index]->name = $league->_name;
            $index++;            
        }

        foreach ($sleeves as $sleeve) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "sleeve-".$sleeve->id;
            $arr_tags[$index]->name = $sleeve->_name;
            $index++;            
        } 

        foreach ($players as $player) {
            $arr_tags[$index] = new Tag();
            $arr_tags[$index]->id = "player-".$player->id;
            $arr_tags[$index]->name = $player->_name;
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
