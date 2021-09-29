<?php

use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\ItemTypeController as AdminItemTypeController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ToppingController as AdminToppingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\FirstTimeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return response()->redirectToRoute('login');
});

Route::middleware('auth')->group(function() {
    Route::middleware('is.not.first-time')->group(function() {
//        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/items/{item}/configure', [ItemController::class, 'configure'])->name('items.configure');

        Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
        Route::post('/cart/add', [CartController::class, 'addItem'])->name('carts.add_item');
        Route::post('/cart/{cart_line}/quantity', [CartController::class, 'changeQuantity'])->name('carts.quantity');
        Route::delete('/cart/{cart_line}/delete', [CartController::class, 'delete'])->name('carts.delete');

        Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/order/{order}/reorder', [OrderController::class, 'reorder'])->name('orders.reorder');
    });

    Route::get('/first-time', [FirstTimeController::class, 'index'])->name('first-time.index');
    Route::post('/first-time', [FirstTimeController::class, 'update'])->name('first-time.update');

    Route::middleware('is.admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('items', AdminItemController::class);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
        Route::resource('toppings', AdminToppingController::class);
        Route::resource('item-types', AdminItemTypeController::class);
    });

});

Route::get('/discord/redirect', fn() => Socialite::driver('discord')->redirect())->name('discord.redirect');
Route::get('/discord/return', [DiscordController::class, 'returnUrl'])->name('discord.return');


require __DIR__.'/auth.php';
