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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('snack', 'Admin\SnackController@index')->name('snack');
    Route::get('snack/{id}', 'Admin\SnackController@show')->name('snack.show');
    Route::get('user', 'Admin\UserController@index')->name('user');
    Route::get('status', 'Admin\StatusController@index')->name('status');
    Route::get('order', 'Admin\OrderController@index')->name('order');
    Route::get('order/{id}', 'Admin\OrderController@show')->name('order.show');
    Route::post('order/{id}', 'Admin\OrderController@update')->name('order.update');
});
