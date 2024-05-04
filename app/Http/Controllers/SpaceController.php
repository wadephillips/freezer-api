<?php

namespace App\Http\Controllers;

use App\Actions\Space\CreateSpaceAction;
use App\Actions\Space\UpdateSpaceAction;
use App\Http\Requests\CreateSpaceRequest;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{

    public function index()
    {
        return response(Space::all(), 200);
    }

    public function store(CreateSpaceRequest $request, CreateSpaceAction $action)
    {

        $space = $action->execute($request->get('name'));
        return response($space);
    }

    public function show(Space $space)
    {
        return $space->load(['sections.items']);
    }

    public function update(CreateSpaceRequest $request, Space $space, UpdateSpaceAction $action)
    {
        $input = $request->validated();
        return response()->json($action->execute($space, $input));
    }

    public function destroy(Space $space)
    {
        return response($space->delete());
    }

}
