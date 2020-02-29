<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newOrders = Order::whereIn('status_id', [2])->orderBy('updated_at', 'asc')->get();
        $inProgressOrders = Order::whereIn('status_id', [3])->get();
        $finishedOrders = Order::whereIn('status_id', [4,5])->orderBy('updated_at', 'desc')->get();
        return view('admin.dashboard', compact('newOrders', 'finishedOrders', 'inProgressOrders'));
    }
}
