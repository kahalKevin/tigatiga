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

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/users/reset-password/{token}', 'UserController@resetPassword');
    Route::post('/users/update-profile/{id}', 'UserController@update');
    Route::post('/users/change-password/{id}', 'UserController@changePassword');
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('page/{type}', 'PageController@index');
Route::get('contactus', 'ContactUsController@index');
Route::post('contactus', 'ContactUsController@store');

Route::prefix('payment')->group(function () {
    Route::post('notification', 'PaymentController@paymentNotification');
});

Route::prefix('shop')->group(function () {
    Route::get('index/{slug}', 'ShopController@index');
    Route::get('index-search', 'ShopController@indexSearch');
    Route::get('indexByTag/{id}', 'ShopController@indexByTag');    
    Route::get('detail/{slug}', 'ShopController@detail');
    Route::get('tracking-order', 'ShopController@trackingOrder');
    Route::get('cart', 'ShopController@cart');
    Route::get('cart/increase-stock/{id}', 'ShopController@increaseStockCart');
    Route::get('cart/decrease-stock/{id}', 'ShopController@decreaseStockCart');
    Route::get('checkout', [
        'as' => 'checkoutLogin',
        'uses' => 'ShopController@checkout'
    ]);
    Route::get('checkoutGuest', [
        'as' => 'checkoutGuest',
        'uses' => 'ShopController@checkoutGuest'
    ]);
    Route::post('addToCart/{product_id}', 'ShopController@addToCart');
    Route::post('add-new-address', 'ShopController@addNewAddress');
    Route::post('set-default-address', 'ShopController@setDefaultAddress');
    Route::post('add-new-addres-guest', 'ShopController@addNewAddressGuest');
});

Route::view('/order', 'order.index');
Route::view('/order/detail', 'order.detail');
Route::view('/order/tracking', 'order.tracking');
Route::view('/order/payment', 'order.payment');
Route::view('/order/search', 'order.search');
Route::view('/order/thanks', 'order.thanks');
Route::view('/order/thanks-cc', 'order.thanks-cc');

Route::group(['prefix' => 'profile',  'middleware' => 'auth'], function () {
    Route::get('/', 'ProfileController@index');
    Route::get('order/history', 'ProfileController@orderHistory');
    Route::get('order/history/detail/{id}', 'ProfileController@orderDetail');
    Route::get('delete-address/{id}', 'ProfileController@deleteAddress');
    Route::post('add-address', 'ProfileController@addAddress');
    Route::post('edit-address', 'ProfileController@editAddress');
});

Route::post('forgot-password', 'UserController@forgotPassword');
Route::view('forgot-password', 'profile.forgot-password');
Route::get('reset-password/{token}', 'UserController@resetPasswordForm');
Route::post('reset-password', 'UserController@resetPassword');

Route::get('shipping/city', 'ShopController@getCity');
Route::get('shipping/cost', 'ShopController@calculateCost');
Route::post('payment/newToken', 'ShopController@newToken');
Route::post('payment/pending', 'PaymentController@pendingPayment');
Route::get('payment/success', 'PaymentController@ccSuccess');

