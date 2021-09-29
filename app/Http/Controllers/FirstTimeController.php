<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstTimeController extends Controller
{
    public function index(Request $request)
    {
        return view('first-time.index', [
            'name' => $request->user()->name
        ]);
    }

    public function update(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return response()->redirectToRoute('first-time.index');
        }

        $user = $request->user();

        $user->name = $name;
        $user->first_time = false;

        $user->save();

        return response()->redirectToRoute('orders.index');
    }
}
