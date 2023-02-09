<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Topping;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('admin.items.index', [
            'items' => Item::all(),
        ]);
    }

    public function create()
    {
        return view('admin.items.create', [
            'itemTypes' => ItemType::all(),
            'toppings' => Topping::active()->get(),
        ]);
    }

    public function store(Request $request)
    {
        if (! ItemType::find($request->item_type)) {
            return response()->redirectToRoute('admin.items.create');
        }

        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'active' => $request->active === 'on',
            'item_type_id' => $request->item_type,
        ]);

        $toppings = $request->toppings;
        $toppingsArray = [];

        if ($toppings) {
            foreach ($toppings as $topping => $value) {
                $toppingModel = Topping::find($topping);

                if (! $toppingModel) {
                    continue;
                }

                $toppingsArray[] = $topping;
            }
        }

        $item->toppings()->sync($toppingsArray);

        return response()->redirectToRoute('admin.items.index');
    }

    public function show(Item $item)
    {
        return view('admin.items.show', [
            'item' => $item,
        ]);
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit', [
            'item' => $item,
            'itemTypes' => ItemType::all(),
            'toppings' => Topping::active()->get(),
        ]);
    }

    public function update(Request $request, Item $item)
    {
        if (! ItemType::find($request->item_type)) {
            return response()->redirectToRoute('admin.items.edit', ['item' => $item]);
        }

        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->active = $request->active === 'on';
        $item->item_type_id = $request->item_type;

        $toppings = $request->toppings;
        $toppingsArray = [];

        if ($toppings) {
            foreach ($toppings as $topping => $value) {
                $toppingModel = Topping::find($topping);

                if (! $toppingModel) {
                    continue;
                }

                $toppingsArray[] = $topping;
            }
        }

        $item->toppings()->sync($toppingsArray);

        $item->save();

        return response()->redirectToRoute('admin.items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->redirectToRoute('admin.items.index');
    }
}
