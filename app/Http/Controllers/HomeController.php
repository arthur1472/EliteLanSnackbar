<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $unfinishedOrders = $user->orders()->whereIn('status_id', [1])->get();
        $newOrders = $user->orders()->whereIn('status_id', [2])->get();
        $inProgressOrders = $user->orders()->whereIn('status_id', [3])->get();
        $finishedOrders = $user->orders()->whereIn('status_id', [4,5])->get();

        return view('home', compact('unfinishedOrders','newOrders','inProgressOrders','finishedOrders'));
    }
}
