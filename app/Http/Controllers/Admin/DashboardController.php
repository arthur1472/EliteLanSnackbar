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
        $unfinishedOrders = Order::whereIn('status_id', [2,3])->get();
        $finishedOrders = Order::whereIn('status_id', [4,5])->get();
        return view('admin.dashboard', compact('unfinishedOrders', 'finishedOrders'));
    }
}
