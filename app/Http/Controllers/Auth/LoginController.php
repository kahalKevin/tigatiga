<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use App\Model\Cart;
use App\Model\Order;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return '_email';
    }

    protected function authenticated(Request $request, $user)
    {
        $session_user_cart = "user_cart";
        $session_guest_no = "guest_no";
        if(\Session::has($session_guest_no) && \Session::has($session_user_cart)){
            $cart = Cart::where('guest_no', '=', \Session::get($session_guest_no))->get();
            if($cart){
                foreach ($cart as $item) {
                    $item->guest_no = null;
                    $item->user_no = Auth::user()->id;
                    $item->save();
                }
                $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
                \Session::forget($session_list_cart_user);
                \Session::push($session_list_cart_user, $cart);
            }
            $order = Order::query()
                ->where('guest_no', \Session::get($session_guest_no))
                ->orWhere('guest_no', \Session::get($session_user_cart))
                ->get();
            if($order){
                foreach ($order as $data) {
                    $data->guest_no = null;
                    $data->user_id = Auth::user()->id;
                    $data->_email = Auth::user()->_email;
                    $data->save();
                }
            }
        }

        $cart_number = Cart::where('user_no', '=', Auth::user()->id)->orderBy('updated_at', 'desc')->first();
        if($cart_number){
            $cart = Cart::where('cart_no', '=', $cart_number->cart_no)->get();
            \Session::put($session_user_cart, $cart_number->cart_no);
            $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
            \Session::forget($session_list_cart_user);
            \Session::push($session_list_cart_user, $cart);            
        }
    }
    
    protected function validateLogin(Request $request)
    {
        Session::put('last_modal', "login");

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request) {
        $session_user_cart = "user_cart";
        $session_guest_no = "guest_no";
        $session_list_cart_user = "user_cart_list-". \Session::get($session_user_cart);
        \Session::forget($session_list_cart_user);
        \Session::forget($session_user_cart);
        \Session::forget($session_guest_no);
        Auth::logout();
        return redirect('/');
    }
}
