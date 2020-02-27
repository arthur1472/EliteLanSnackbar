<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('admin.dashboard');
        }

        $paid = $request->post('paid');

        if ($paid !== null) {
            $order->paid = ($paid) ? 1 : 0;
        }

        $status_id = $request->post('status');
        if ($status_id !== null) {
            $status = Status::find($status_id);
            $order->status_id = ($status) ? $status->id : $order->status_id;
        }

        $order->save();
        return redirect()->route('admin.order.show', ['id' => $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
