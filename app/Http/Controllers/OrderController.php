<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $ordersStatuses = $user->orders()->with('status')->get()->sortByDesc('id')->groupBy('status_id');

        return view('orders.index', [
            'ordersStatuses' => $ordersStatuses,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart;

        $inactiveProducts = collect();

        foreach ($cart->cartLines as $cartLine) {
            if (!$cartLine->item->active || !$cartLine->item->type->active) {
                $inactiveProducts->add($cartLine->item->name);
                $cartLine->delete();
            }
        }

        if ($inactiveProducts->count() > 0) {
            return response()->redirectToRoute('carts.index')->with('productNames', $inactiveProducts);
        }

        Order::importFromCart($cart, $request->note);

        return response()->redirectToRoute('orders.index')->with('success', 'true');
    }

    public function reorder(Request $request, Order $order)
    {
        if ($request->user()->id !== $order->user_id) {
            return response()->redirectToRoute('carts.index');
        }

        Cart::importFromOrder($order);
        return response()->redirectToRoute('carts.index');
    }
}
