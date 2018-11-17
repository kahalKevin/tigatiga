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
    Route::get('index/{category_id}', 'ShopController@index');
    Route::get('detail/{slug}', 'ShopController@detail');
    Route::get('checkout', 'ShopController@checkout');
});

Route::prefix('order')->group(function () {
    Route::view('tracking', 'order.tracking');
    Route::view('payment', 'order.payment');
    Route::view('search', 'order.search');
    Route::view('thanks', 'order.thanks');
    Route::view('thanks-cc', 'order.thanks-cc');
});

Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@index');
    Route::get('order/history', 'ProfileController@orderHistory');
    Route::view('order/history/detail', 'order.detail');
});

Route::view('forgot-password', 'profile.forgot-password');
Route::view('reset-password', 'profile.reset-password');

//Route::get('/home', 'HomeController@index')->name('home');
