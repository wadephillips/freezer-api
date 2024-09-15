<?php

namespace App\Http\Controllers;

use App\Actions\Section\CreateSectionAction;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {

        $sections = Section::all();

        return response()->json(SectionResource::collection($sections));
    }

    public function store(StoreSectionRequest $request, CreateSectionAction $action)
    {
        $validated = $request->validated();
        $section = $action->execute($validated['name'], $validated['description'] ?? '', $validated['space_id']);
        $section->load('space');

        return response()->json(SectionResource::make($section));
    }

    public function show(Section $section)
    {
        return response()->json(SectionResource::make($section));
    }

    public function update(Request $request, Section $section) {}

    public function destroy(Section $section) {}
}
