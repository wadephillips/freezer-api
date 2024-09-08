<?php

use App\Models\Section;
use App\Models\Space;

//todo resume: just copied all of this over and I'm starting to work on this.  Need to add routes and a controller. A good thing todo would be to bump laravel to 11x

it('returns a collection of all available sections', function () {

    Space::factory(2)->create()
        ->each(fn ($space) => Section::factory(10)->create(['space_id' => $space->id]));

    $response = $this->get(route('sections.index'));
    expect($response->status())->toBe(200);
    expect($response->json())->toBeArray();
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
    Section::factory(1)->create(['name' => 'Garage Freezer']);
    $response = $this->get(config('app.url').'/api/spaces/1');
    expect($response->status())->toBe(200);
    expect($response->json())->toBeArray();
    expect($response->json()['data']['name'])->toBe('Garage Freezer');
})->todo();

it('retrieves all Sections for a specific Space', function () {})->todo();
it('does not retrieve sections that do not belong to the specified space', function () {})->todo();

it('deletes a Section with a Delete request', function () {
    $before = Section::count(); //causing Http request to time out??
    expect($before)->toEqual(0);
    Section::factory(1)->create();
    $response = $this->delete(config('app.url').'/api/spaces/1');
    expect($response->status())->toBe(204);
    $spaces = Section::count();
    expect($spaces)->toEqual(0);
})->todo();
