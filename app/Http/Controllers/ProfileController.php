<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\UserAddress;
use App\Model\Order;
use App\Model\OrderDetail;

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
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        $order_detail_list_history = collect();
        foreach ($orders as $order) {
            $order_details = OrderDetail::where('order_id', '=', $order->id)->get();
            foreach ($order_details as $order_detail) {
                $order_detail_list_history->push($order_detail);
            }
        }
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('order.index')->with(compact('order_detail_list_history', 'cmsUrl'));
    } 

    public function orderDetail($id)
    {
        $order = Order::where('id', '=', $id)->first();
        $order_detail = OrderDetail::where('order_id', '=', $order->id)->get();        
        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        $last_status = 0;
        if($order->status_id == 'STATUSORDER0' || $order->status_id == 'STATUSORDER10'){
            $last_status = 1;
        } else if ($order->status_id == 'STATUSORDER1' || $order->status_id == 'STATUSORDER7'){
            $last_status = 2;
        } else if ($order->status_id == 'STATUSORDER2'){
            $last_status = 3;
        } else if ($order->status_id == 'STATUSORDER3' || $order->status_id == 'STATUSORDER4'){
            $last_status = 4;
        } else if ($order->status_id == 'STATUSORDER9'){
            $last_status = 5;
        } else {
            $last_status = 6;
        } 
        return view('order.detail')->with(compact('order', 'order_detail', 'cmsUrl', 'last_status'));
    }    
}
