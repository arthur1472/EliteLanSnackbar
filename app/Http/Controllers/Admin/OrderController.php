<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::all()->sortBy(['status_id', 'id']),
        ]);
    }

    public function indexUpdate(Request $request)
    {
        $orderId         = $request->order_id;
        $request->status = Status::find($request->status_id)->getKey();

        return $this->update($request, Order::find($orderId));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order'    => $order,
            'statuses' => Status::all(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        if ($order->status_id === Status::AFGEWEZEN) {
            return response()->redirectToRoute('admin.orders.index');
        }

        $order->status_id   = $request->status;
        $order->system_note = $request->system_note;

        $order->save();

        if ((int)$request->status === Status::AFGEWEZEN) {
            $user = $order->user;

            $user->wallet = $user->wallet->add($order->total_price);
            $user->save();
        }

        return response()->redirectToRoute('admin.orders.index');
    }
}
