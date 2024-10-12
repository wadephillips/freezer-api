<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpaceController extends Controller
{

    public function index()
    {

        $spaces = Space::all();

        return Inertia::render('Spaces', ['spaces' => $spaces,]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Space $space)
    {

        return Inertia::render('Space', [ 'space' => $space,]);
    }

    public function edit(Space $space)
    {
    }

    public function update(Request $request, Space $space)
    {
    }

    public function destroy(Space $space)
    {
    }

}
