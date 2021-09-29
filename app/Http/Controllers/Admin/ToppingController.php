<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    public function index()
    {
        return view('admin.toppings.index', [
            'toppings' => Topping::all(),
        ]);
    }

    public function create()
    {
        return view('admin.toppings.create');
    }

    public function store(Request $request)
    {
        Topping::create([
            'name'     => $request->name,
            'active'   => $request->active === 'on',
        ]);

        return response()->redirectToRoute('admin.toppings.index');
    }

    public function show(Topping $topping)
    {
        return view('admin.toppings.show', [
            'topping' => $topping,
        ]);
    }

    public function edit(Topping $topping)
    {
        return view('admin.toppings.edit', [
            'topping' => $topping,
        ]);
    }

    public function update(Request $request, Topping $topping)
    {
        $topping->name     = $request->name;
        $topping->active   = $request->active === 'on';

        $topping->save();

        return response()->redirectToRoute('admin.toppings.index');
    }

    public function destroy(Topping $topping)
    {
        $topping->delete();
        return response()->redirectToRoute('admin.toppings.index');
    }
}
