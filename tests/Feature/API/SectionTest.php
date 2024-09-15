<?php

use App\Models\Section;
use App\Models\Space;

it('returns a collection of all available sections', function () {

    Space::factory(2)->create()
        ->each(fn ($space) => Section::factory(10)->create(['space_id' => $space->id]));

    $response = $this->get(route('sections.index'));
    expect($response->status())->toBe(200)->and($response->json())->toBeArray();
    $dbCount = Section::count('id');
    expect($dbCount)->toEqual(20);
});

it('creates a new Section from a POST request', function () {

    $space = Space::factory()->create();
    $response = $this->post(route('sections.store', ['name' => 'Deep Right', 'space_id' => $space->id]));
    expect($response->status())->toBe(200);
    $spaces = Section::count();
    expect($spaces)->toEqual(1)
        ->and($response->json())
        ->toBeArray()
        ->toHaveKey('name', 'Deep Right')
        ->toHaveKey(
            'description',
            ''
        )->toHaveKey('space_id', 1)
        ->toHaveKey('items')
        ->toHaveKey('unique_items_count')
        ->toHaveKey('space');
});

it('gets a Section with a GET request', function () {
    $before = Section::count();
    expect($before)->toEqual(0);
    $section = Section::factory(1)->create(['name' => 'Lower Right'])->first();
    $response = $this->get(route('sections.destroy', ['section' => $section->id,]));
    //$response = $this->get(config('app.url').'/api/sections/1');
    $response->assertJsonIsObject();
    $response->assertOk();
    expect($response->json())
        ->toBeArray()
        ->toHaveKey('name', 'Lower Right')
        ->toHaveKey('description');
});


it('deletes a Section with a Delete request', function () {
    $before = Section::count(); //causing Http request to time out??
    expect($before)->toEqual(0);
    $section = Section::factory(1)->create()->first();

    $response = $this->delete(route('sections.destroy', ['section' => $section->id,]));

    expect($response->status())->toBe(204);
    $spaces = Section::count();
    expect($spaces)->toEqual(0);
});
