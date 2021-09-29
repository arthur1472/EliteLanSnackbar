<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    public function index()
    {
        return view('admin.item-types.index', [
            'itemTypes' => ItemType::all()->sortBy('priority'),
        ]);
    }

    public function create()
    {
        return view('admin.item-types.create');
    }

    public function store(Request $request)
    {
        ItemType::create([
            'name'     => $request->name,
            'priority' => $request->priority,
            'active'   => $request->active === 'on',
        ]);

        return response()->redirectToRoute('admin.item-types.index');
    }

    public function show(ItemType $itemType)
    {
        return view('admin.item-types.show', [
            'itemType' => $itemType,
        ]);
    }

    public function edit(ItemType $itemType)
    {
        return view('admin.item-types.edit', [
            'itemType' => $itemType,
        ]);
    }

    public function update(Request $request, ItemType $itemType)
    {
        $itemType->name     = $request->name;
        $itemType->priority = $request->priority;
        $itemType->active   = $request->active === 'on';

        $itemType->save();

        return response()->redirectToRoute('admin.item-types.index');
    }

    public function destroy(ItemType $itemType)
    {
        $itemType->delete();

        return response()->redirectToRoute('admin.item-types.index');
    }
}
