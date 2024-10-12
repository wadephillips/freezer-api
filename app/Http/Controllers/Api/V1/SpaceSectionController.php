<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SpaceResource;
use App\Models\Section;
use App\Models\Space;

class SpaceSectionController extends Controller
{
    public function index(Space $space)
    {

        $space->load('sections');

        return response()->json(SpaceResource::make($space));
    }

    public function show(Space $space, Section $section)
    {

        return response()->json(SectionResource::make($section));
    }
}
