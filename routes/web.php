<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

\Route::group(['middleware' => 'auth'], function () {
Route::get('logout', 'Auth\LoginController@logout');
Route::post('/users/update-profile/{id}', 'UserController@update');
Route::get('/', function () {
            return view('index');
        });
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::prefix('payment')->group(function () {
    Route::post('notification', 'PaymentController@paymentNotification');
});

Route::prefix('shop')->group(function () {
    Route::get('index/{slug}', 'ShopController@index');
    Route::get('indexByTag/{id}', 'ShopController@indexByTag');    
    Route::get('detail/{slug}', 'ShopController@detail');
    Route::get('cart', 'ShopController@cart');
    Route::get('cart/increase-stock/{id}', 'ShopController@increaseStockCart');
    Route::get('cart/decrease-stock/{id}', 'ShopController@decreaseStockCart');
    Route::get('checkout', 'ShopController@checkout');
    Route::get('checkoutGuest', 'ShopController@checkoutGuest');
    Route::view('shoppingcart', 'shop.cart');
    Route::post('addToCart/{product_id}', 'ShopController@addToCart');
});

Route::view('/order', 'order.index');
Route::view('/order/detail', 'order.detail');
Route::view('/order/tracking', 'order.tracking');
Route::view('/order/payment', 'order.payment');
Route::view('/order/search', 'order.search');
Route::view('/order/thanks', 'order.thanks');
Route::view('/order/thanks-cc', 'order.thanks-cc');

Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@index');
    Route::get('order/history', 'ProfileController@orderHistory');
    Route::view('order/history/detail', 'order.detail');
});

Route::view('forgot-password', 'profile.forgot-password');
Route::view('reset-password', 'profile.reset-password');

Route::get('shipping/city', 'ShopController@getCity');
Route::get('shipping/cost', 'ShopController@calculateCost');
Route::get('payment/newToken', 'ShopController@newToken');

