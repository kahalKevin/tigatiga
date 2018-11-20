<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Type;
use App\Model\Size;
use App\Model\ProductGallery;
use App\Model\ProductStock;
use App\Model\Cart;
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
        $products = Product::where('category_id', '=', $category->id)->get();

        $genders = Type::where('category_id', '=', 11)->get();
        $sizes = Size::where('_active', '=', "1")->get();
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('shop.index')->with(compact('products', 'category', 'genders', 'sizes', 'category_parent', 'cmsUrl'));
    }

    public function detail(Request $request, $slug)
    {   
                   //dd(\Session::get("user_cart_list-5bf36b6fc57d6"));
        // $list_cart_item = \Session::get("user_cart_list-5bf36b6fc57d6");
        // foreach($list_cart_item[0] as $cart_item){
        //     dd($cart_item->productStocks()->get()[0]->size()->get()[0]->_name);
        // }
        $product = Product::where('_slug', '=', $slug)->first();
        $category = Category::where('id', '=', $product->category_id)->first();
        $category_parent = Category::where('id', '=', $category->parent_category_id)->first();
        $products_sizes = ProductStock::where('product_id', '=', $product->id)->get();
        $products_galleries = ProductGallery::where('product_id', '=', $product->id)->get();
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
                           'related_products'));
    }

    public function checkout()
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
        
        return view('shop.checkout', compact('token'));
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
            $product_stock->_stock = $product_stock->_stock - $request->quantity;
            $product_stock->save();

            $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
            $list_cart_user = Cart::where('cart_no', '=', \Session::get($session_user_cart))->get();
            
            \Session::forget($session_list_cart_user);
            \Session::push($session_list_cart_user, $list_cart_user);
        }
    }
}
