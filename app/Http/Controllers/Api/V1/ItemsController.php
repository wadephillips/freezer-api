<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Item\CreateItemAction;
use App\Http\Controllers\Controller;
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

    public function destroy(Item $item)
    {

        $deleted = $item->delete();
        $code = $deleted ? 203 : 400;

        return response()->json()->setStatusCode($code);
    }
}
