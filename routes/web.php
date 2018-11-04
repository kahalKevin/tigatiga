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

Route::view('/test', 'test');

Route::get('/', 'HomeController@index')->name('home.index');

// Route::prefix('payment')->group(function () {
//     Route::post('notification', 'PaymentController@paymentNotification');
// });

Route::view('/shop', 'shop.index');
Route::view('/shop/detail', 'shop.detail');
Route::view('/shop/checkout', 'shop.checkout');

Route::view('/order', 'order.index');
Route::view('/order/detail', 'order.detail');
Route::view('/order/tracking', 'order.tracking');
Route::view('/order/payment', 'order.payment');
Route::view('/order/search', 'order.search');
Route::view('/order/thanks', 'order.thanks');
Route::view('/order/thanks-cc', 'order.thanks-cc');

Route::view('/profile', 'profile.index');
Route::view('/profile/forgot-password', 'profile.forgot-password');
Route::view('/profile/reset-password', 'profile.reset-password');




