<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function index()
    {
        $items = Item::all();
        //dd($items);
        return response($items);
    }

    public function store(Request $request)
    {
    }

    public function show(Item $item)
    {
    }

    public function update(Request $request, Item $item)
    {
    }

    public function destroy(Item $item)
    {
    }

}
