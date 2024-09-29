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
    $response = $this->get(route('sections.destroy', ['section' => $section->id,],['Accept' => 'application/json']));
    $response->assertJsonIsObject();
    $response->assertOk();
    expect($response->json())
        ->toBeArray()
        ->toHaveKey('name', 'Lower Right')
        ->toHaveKey('description');
});

it('updates a section', function () {

    $section = Section::factory(1)->for(Space::factory())->create(['name' => 'Lower Left'])->first();
    $this->assertDatabaseHas('sections', ['name' => 'Lower Left',]);
    $this->assertDatabaseCount('spaces', 1);

    $response = $this->patch(
            route('sections.update', ['section' => $section->id]),
            ['name' => 'Deep Left', 'space_id' => $section->space_id, ]
        );

    $response->assertOk();
    $response->assertJsonIsObject();
    expect($response->json())->toHaveKey('name', 'Deep Left');

});

it('validates update requests and needs specific items', function ($name, $description, $spaceId) {
    $section = Section::factory(1)->for(Space::factory())->create(['name' => 'Lower Left'])->first();

    $response = $this->patch(
        route('sections.update', ['section' => $section->id]),
        ['name' => $name, 'description' => $description, 'space_id' => $spaceId],
        ['Accept' => 'application/json']
    );
    expect($response->getStatusCode())->toBe(422);
})->with([
    [null, 'a description', 1],
    [1, 'a description', 1],
    ['Middle Center', 22, 1],
    ['Middle Center', 'a description', null],
    ['Middle Center', 'a description', 0],
    ['Middle Center', 'a description', 'foo'],
]);


it('deletes a Section with a Delete request', function () {
    $before = Section::count(); //causing Http request to time out??
    expect($before)->toEqual(0);
    $section = Section::factory(1)->create()->first();

    $response = $this->delete(route('sections.destroy', ['section' => $section->id,]));

    expect($response->status())->toBe(204);
    $spaces = Section::count();
    expect($spaces)->toEqual(0);
});
