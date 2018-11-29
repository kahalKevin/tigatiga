<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\UserAddress;
use App\Model\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        
        $total_order = Order::where([
            ['user_id', '=', $user_id]
        ])->count();

        $total_delivery = Order::where([
            ['user_id', '=', $user_id],
            ['status_id', '=', 'STATUSORDER4']
        ])->count();

        $total_received = Order::where([
            ['user_id', '=', $user_id],
            ['status_id', '=', 'STATUSORDER9']
        ])->count();

        $addresses = UserAddress::where('user_id', $user_id)->get();

        return view('profile.index', compact(
              'total_order',
              'total_delivery',
              'total_received',
              'addresses'
            )
        );
    }

    public function orderHistory()
    {
        $order = Auth::user()->with('orders')->get();

        return view('order.index');
    }
}
