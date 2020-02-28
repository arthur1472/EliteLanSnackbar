<?php

namespace App\Http\Controllers;

use App\Order;
use App\Snack;
use App\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('home');
        }

        if ($order->user->id != $request->user()->id) {
            return redirect()->route('home');
        }

        return view('order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Status $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if ($order->submitted) {
            return redirect()->route('home');
        }

        if ($order->user->id != $request->user()->id) {
            return redirect()->route('home');
        }

        $activeSnacks = Snack::where('active', 1)->get();
        return view('orderedit', compact('order','activeSnacks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Status $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if ($order->submitted) {
            return redirect()->route('home');
        }

        if ($order->user->id != $request->user()->id) {
            return redirect()->route('home');
        }

        $snackToAdd = $request->post('addSnack');
        if ($snackToAdd) {
            $snack = Snack::find($snackToAdd);
            if (!$snack) {
                return redirect()->route('order.edit', ['id' => $order_id]);
            }

            if (!$snack->active) {
                return redirect()->route('order.edit', ['id' => $order_id]);
            }

            $currentSnack = $order->snack()->where('snacks.id', $snack->id)->first();
            if ($currentSnack) {
                $order->snack()->updateExistingPivot($currentSnack, [
                    'amount' => $currentSnack->pivot->amount + 1,
                    'price' => $currentSnack->pivot->price + $snack->price,
                ], false);
                $order->save();
            } else {
                $order->snack()->attach($snack, ['amount' => 1, 'price' => $snack->price]);
                $order->save();

            }
        }

        $snackToRemove = $request->post('removeSnack');
        if ($snackToRemove) {
            $snack = Snack::find($snackToRemove);
            if (!$snack) {
                return redirect()->route('order.edit', ['id' => $order_id]);
            }

            $currentSnack = $order->snack()->where('snacks.id', $snack->id)->first();
            if ($currentSnack) {
                if ($currentSnack->pivot->amount === 1) {
                    $order->snack()->detach($snack);
                } else {
                    $order->snack()->updateExistingPivot($currentSnack, [
                        'amount' => $currentSnack->pivot->amount - 1,
                        'price' => $currentSnack->pivot->price - $snack->price,
                    ], false);
                    $order->save();
                }
            }
        }

        if ($request->post('save')) {
            $userNote = $request->post('user_note');
            $order->user_note = $userNote;
            $order->save();
            return redirect()->route('home');
        }

        if ($request->post('complete')) {
            $userNote = $request->post('user_note');
            $order->user_note = $userNote;
            $order->submitted = 1;
            $order->status_id = 2;
            $order->save();
            return redirect()->route('home');
        }

        return redirect()->route('order.edit', ['id' => $order_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $order = new Order;
        $order->user_id = $request->user()->id;
        $order->save();

        $activeSnacks = Snack::where('active', 1)->get();
        return view('ordercreate', compact('activeSnacks', 'order'));
    }
}
