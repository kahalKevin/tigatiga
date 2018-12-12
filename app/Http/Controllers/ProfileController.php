<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\UserAddress;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Helpers\RajaOngkir;
use Carbon\Carbon;

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

        $addresses = UserAddress::where('user_id', $user_id)->limit(3)->get();

        $province = RajaOngkir::getProvince();
        $city = RajaOngkir::getCity();

        return view('profile.index', compact(
              'total_order',
              'total_delivery',
              'total_received',
              'addresses',
              'province',
              'city'
            )
        );
    }

    public function orderHistory(Request $request)
    {   
        $orders = Order::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $cmsUrl = env("IMG_URL_PREFIX", "http://localhost:8080");
        return view('order.index', compact('orders', 'cmsUrl'));
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

    public function editAddress(Request $request)
    {
        $user_address = UserAddress::find($request->id);
        $user_address->_address = $request->address;

        $user_address->_title = "Rumah";
        $user_address->_receiver_name = $request->receiver_name;
        $user_address->_receiver_phone = $request->phone;
        $user_address->ro_city_id = $request->city;
        $user_address->ro_province_id = $request->provinsi;
        $user_address->_kota = $request->city;
        $user_address->_kode_pos = $request->postal_code;
        $user_address->updated_at = Carbon::now();
        $user_address->save();

        return redirect()->back();
    }

    public function  deleteAddress(Request $request)
    {
        $user_address = UserAddress::find($request->id);

        if ($user_address->_default === '1') {
            $all_address = UserAddress::where([
                    ['user_id', '=', Auth::user()->id],
                    ['id', '!=', $request->id]
                ]
            )->first();

            if (!empty($all_address)) {
                $all_address->_default = '1';
                $all_address->save();
            }
        }

        $user_address->_default = '0';
        $user_address->save();
        $user_address->delete();

        return redirect()->back();
    }
}
