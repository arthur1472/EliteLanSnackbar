<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}/configure', [ItemController::class, 'configure'])->name('items.configure');
    Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('carts.add_item');
    Route::post('/cart/{cart_line}/quantity', [CartController::class, 'changeQuantity'])->name('carts.quantity');
    Route::delete('/cart/{cart_line}/delete', [CartController::class, 'delete'])->name('carts.delete');
    Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
