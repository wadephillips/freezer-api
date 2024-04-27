<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{

    public function index()
    {
        return response(Space::all(), 200);
    }

    public function store(Request $request)
    {
    }

    public function show(Space $space)
    {
    }

    public function update(Request $request, Space $space)
    {
    }

    public function destroy(Space $space)
    {
    }

}
