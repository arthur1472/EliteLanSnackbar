<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemType;
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
        ]);
    }

    public function store(Request $request)
    {
        if (! ItemType::find($request->item_type)) {
            return response()->redirectToRoute('admin.items.create');
        }

        Item::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'active'       => $request->active === 'on',
            'item_type_id' => $request->item_type,
        ]);

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
            'item'      => $item,
            'itemTypes' => ItemType::all(),
        ]);
    }

    public function update(Request $request, Item $item)
    {
        if (! ItemType::find($request->item_type)) {
            return response()->redirectToRoute('admin.items.edit', ['item' => $item]);
        }

        $item->name         = $request->name;
        $item->description  = $request->description;
        $item->price        = $request->price;
        $item->active       = $request->active === 'on';
        $item->item_type_id = $request->item_type;

        $item->save();

        return response()->redirectToRoute('admin.items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->redirectToRoute('admin.items.index');
    }
}
