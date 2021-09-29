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

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order'    => $order,
            'statuses' => Status::all(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $order->status_id   = $request->status;
        $order->system_note = $request->system_note;

        $order->save();

        return response()->redirectToRoute('admin.orders.index');
    }
}
