<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomeBanner;
use App\Model\Product;
use App\Model\InventoryAds;
use Carbon\Carbon;
use DB;

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
        $inventory_ads = InventoryAds::query()
            ->where('_start_date', '<', Carbon::now())
            ->where('_end_date', '>', Carbon::now())
            ->first();
            
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('home.index', compact(
            'home_banners', 
            'latest_products', 
            'best_products', 
            'inventory_ads',
            'cmsUrl')
        );
    }
}
