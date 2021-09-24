<?php

namespace App\Http\Controllers;

use App\Models\CartLines;
use App\Models\Item;
use App\Models\Topping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('carts.index', [
            'cart' => $request->user()->cart->with('cartLines')->first(),
        ]);
    }

    public function addItem(Request $request)
    {
        $itemId = (int)$request->itemId;
        $user   = $request->user();
        $cart   = $user->cart;

        $item = Item::find($itemId);

        if (! $item) {
            return response()->redirectToRoute('items.index');
        }

        $toppings      = $request->toppings;
        $toppingsArray = [];

        if ($toppings) {
            foreach ($toppings as $topping => $value) {
                $toppingModel = Topping::find($topping);

                if (! $toppingModel) {
                    return response()->redirectToRoute('items.configure', ['item' => $item->id]);
                }

                if (! $item->hasTopping($toppingModel)) {
                    return response()->redirectToRoute('items.configure', ['item' => $item->id]);
                }

                $toppingsArray[] = $topping;
            }
        }

        $cart->addItem($itemId, toppings: $toppingsArray === [] ? null : $toppingsArray);

        return response()->redirectToRoute('carts.index');
    }

    public function changeQuantity(Request $request, CartLines $cart_line)
    {
        $quantity = (int)$request->quantity;

        if ($request->user()->id !== $cart_line->cart->user_id) {
            return response()->redirectToRoute('carts.index');
        }

        if ($quantity === 0 || $quantity > 20) {
            return response()->redirectToRoute('carts.index');
        }

        $cart_line->quantity = $quantity;
        $cart_line->save();

        return response()->redirectToRoute('carts.index');
    }

    public function delete(Request $request, CartLines $cart_line)
    {
        if ($request->user()->id !== $cart_line->cart->user_id) {
            return response()->redirectToRoute('carts.index');
        }

        $cart_line->delete();

        return response()->redirectToRoute('carts.index');
    }
}
