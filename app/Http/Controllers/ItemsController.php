<?php

namespace App\Http\Controllers;

use App\Actions\Item\CreateItemAction;
use App\Http\Requests\CreateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return response($items);
    }

    public function store(CreateItemRequest $request, CreateItemAction $action)
    {

        $valid = $request->validated();
        $item = $action->execute($valid['name'], $valid['description'], $valid['size']);

        return response()->json($item);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function update(Request $request, Item $item) {}

    public function destroy(Item $item) {}
}
