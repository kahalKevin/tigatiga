<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomeBanner;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_banners = HomeBanner::orderBy('created_at','desc')->get();

        return view('home.index', compact('home_banners'));
    }
}
