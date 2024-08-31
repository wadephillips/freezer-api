<?php

namespace App\Http\Controllers;

use App\Actions\Item\CreateItemAction;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

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

    public function update(UpdateItemRequest $request, Item $item)
    {

        $saved = $item->update($request->validated());

        return response()->json($item)->setStatusCode(($saved) ? 200 : 400);
    }

    public function destroy(Item $item) {}
}
