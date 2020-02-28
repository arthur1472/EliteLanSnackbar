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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/order/create', 'OrderController@create')->name('order.create')->middleware('auth');
Route::get('/order/{id}/update', 'OrderController@edit')->name('order.edit')->middleware('auth');
Route::get('/order/{id}', 'OrderController@show')->name('order.show')->middleware('auth');
Route::post('/order/{id}', 'OrderController@update')->name('order.update')->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard')->middleware(['role:admin']);
    Route::get('snack', 'Admin\SnackController@index')->name('snack')->middleware(['role:admin']);
    Route::get('snack/create', 'Admin\SnackController@create')->name('snack.create')->middleware(['role:admin']);
    Route::post('snack/create', 'Admin\SnackController@store')->name('snack.store')->middleware(['role:admin']);
    Route::get('snack/{id}', 'Admin\SnackController@show')->name('snack.show')->middleware(['role:admin']);
    Route::post('snack/{id}', 'Admin\SnackController@update')->name('snack.update')->middleware(['role:admin']);
    Route::get('user', 'Admin\UserController@index')->name('user')->middleware(['role:admin']);
    Route::get('status', 'Admin\StatusController@index')->name('status')->middleware(['role:admin']);
    Route::get('order', 'Admin\OrderController@index')->name('order')->middleware(['role:admin']);
    Route::get('order/{id}', 'Admin\OrderController@show')->name('order.show')->middleware(['role:admin']);
    Route::post('order/{id}', 'Admin\OrderController@update')->name('order.update')->middleware(['role:admin']);
});
