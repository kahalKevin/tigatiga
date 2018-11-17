<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Type;
use App\Model\Size;

class ShopController extends Controller
{
    public function index(Request $request, $category_id) 
    {
        $products = Product::where('category_id', '=', $category_id)->get();
        $genders = Type::where('category_id', '=', 11)->get();
        $sizes = Size::get();

        return view('shop.index');
    }

    public function detail(Request $request, $slug)
    {
        // $product = Product::with('productGalleries', 'productStocks')->where('_slug', '=', $slug)->first();
        // $related_products =  Product::where('category_id', '=' , $product->category_id)->limit(4)->get();

        return view('shop.detail');
    }

    public function checkout()
    {
        return view('shop.checkout');
    }
}
