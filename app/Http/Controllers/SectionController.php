<?php

namespace App\Http\Controllers;

use App\Actions\Section\CreateSectionAction;
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

    public function store(Request $request,  CreateSectionAction $action)
    {

    }

    public function show(Section $section)
    {
    }

    public function update(Request $request, Section $section)
    {
    }

    public function destroy(Section $section)
    {
    }

}
