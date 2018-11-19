<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Type;
use App\Model\Size;
use App\Model\ProductGallery;
use App\Model\ProductStock;

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
        $product = Product::where('_slug', '=', $slug)->first();
        $category = Category::where('id', '=', $product->category_id)->first();
        $category_parent = Category::where('id', '=', $category->parent_category_id)->first();
        $products_sizes = ProductStock::where('product_id', '=', $product->id)->get();
        $products_galleries = ProductGallery::where('product_id', '=', $product->id)->get();
        $related_products =  Product::where('category_id', '=' , $product->category_id)->limit(4)->get();
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");

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
        return view('shop.checkout');
    }

    public function addToCart(Request $request, $product_id)
    {
        $avaibility = false;
    }
}
