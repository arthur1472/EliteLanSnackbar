<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PreparationController extends Controller
{
    public function index()
    {
        $newOrders     = Order::new()
                              ->with('user')
                              ->orderBy('id')
                              ->get();
        $prepareOrders = Order::prepare()
                              ->with('user')
                              ->orderBy('id')
                              ->get();

        $doneOrders    = Order::ready()
                              ->where('updated_at', '>', Carbon::now()->subMinutes(30))
                              ->with('user')
                              ->orderBy('updated_at', 'desc')
                              ->limit(20)
                              ->get();

        return view('preparation.index', compact('newOrders', 'prepareOrders', 'doneOrders'));
    }
}
