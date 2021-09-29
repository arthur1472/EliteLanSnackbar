<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index')->with([
            'itemTypes' => ItemType::active()->get()->sortBy('priority'),
        ]);
    }

    public function configure(Request $request, Item $item)
    {
        if ($item->toppings()->count() === 0) {
            return response()->redirectToRoute('items.index');
        }

        return view('items.configure', [
            'item' => $item
        ]);
    }
}
