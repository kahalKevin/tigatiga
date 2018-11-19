<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\Order;

class ProfileController extends Controller
{
    public function index()
    {
        // $profile = Auth::user()->with('addresses', 'orders')->first();

        return view('profile.index');
    }

    public function orderHistory()
    {
        // $order = Auth::user()->with('orders')->first();

        return view('order.index');
    }
}
