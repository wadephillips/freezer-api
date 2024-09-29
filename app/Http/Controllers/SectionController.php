<?php

namespace App\Http\Controllers;

use App\Actions\Section\CreateSectionAction;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as Status;

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

    public function update(UpdateSectionRequest $request, Section $section) {

        $validated = $request->validated();
        $section->update($validated);
        return response()->json(SectionResource::make($section));
    }

    public function destroy(Section $section) {
        $deleted = $section->delete();
        return response([],$deleted ? Status::HTTP_NO_CONTENT : Status::HTTP_BAD_REQUEST);
    }
}
