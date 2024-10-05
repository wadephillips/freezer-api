<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpaceResource;
use App\Models\Section;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceSectionController extends Controller
{
    public function index(Space $space)
    {

        $space->load('sections');

        return response()->json(SpaceResource::make($space));
    }

    public function store(Request $request) {}

    public function show(Section $section) {}

    public function update(Request $request, Section $section) {}

    public function destroy(Section $section) {}
}
