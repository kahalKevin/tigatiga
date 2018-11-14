<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomeBanner;
use App\Model\Product;
use App\Model\InventoryAds;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_banners = HomeBanner::orderBy('created_at','desc')
            ->get();

        $latest_products = Product::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $best_products = Product::orderBy('_count_view', 'desc')
            ->limit(4)
            ->get();

        $inventory_ads = InventoryAds::latest()
            ->first();

        return view('home.index', compact(
            'home_banners', 
            'latest_products', 
            'best_products', 
            'inventory_ads')
        );
    }
}
