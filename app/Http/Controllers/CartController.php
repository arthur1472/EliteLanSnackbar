<?php

namespace App\Http\Controllers;

use App\Models\CartLines;
use App\Models\Item;
use App\Models\Topping;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('carts.index', [
            'cart'   => $request->user()->cart,
            'errors' => $request->errors ?? null,
        ]);
    }

    public function addItem(Request $request)
    {
        $itemId = (int)$request->itemId;
        $user   = $request->user();
        $cart   = $user->cart;

        $item = Item::find($itemId);

        $lock = Cache::lock("{$item->getKey()}_cart_mutation", 10);

        try {
            $lock->block(10);

            if (! $item) {
                return response()->redirectToRoute('items.index');
            }

            if (! $item->isAvailableToOrder()) {
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

            $cart->addItem($item, toppings: $toppingsArray === [] ? null : $toppingsArray);
        } catch (LockTimeoutException $e) {
            dd($e);
        } finally {
            $lock?->release();
        }

        return response()->redirectToRoute('carts.index');
    }

    public function changeQuantity(Request $request)
    {
        $itemId = (int)$request->item_id;
        $action = $request->action;

        $item = Item::find($itemId);

        $lock = Cache::lock("{$item->getKey()}_cart_mutation", 10);

        try {
            $lock->block(10);

            $cartLine = $request->user()
                ->cart
                ?->cartLines
                ?->where('item_id', $itemId)
                ?->where('toppings', null)
                ?->first();

            if (! $item->active) {
                $cartLine->delete();

                return response()->redirectToRoute('carts.index');
            }

            if (! $cartLine) {
                return response()->redirectToRoute('carts.index');
            }

            if ($action === '-' && $cartLine->quantity === 1) {
                $cartLine->delete();

                return response()->redirectToRoute('carts.index');
            }

            if ($action === '-') {
                --$cartLine->quantity;
                $cartLine->save();

                return response()->redirectToRoute('carts.index');
            }

            if ($action === '+') {
                $cartLine->cart->addItem($item);

                return response()->redirectToRoute('carts.index');
            }
        } catch (LockTimeoutException $e) {
            dd($e);
        } finally {
            $lock?->release();
        }

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
