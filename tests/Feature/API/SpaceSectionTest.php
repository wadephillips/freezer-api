<?php

use App\Models\Section;
use App\Models\Space;

//use Illuminate\Foundation\Testing\RefreshDatabase;
it('retrieves all Sections for a specific Space', function () {

    $spaces = Space::factory(2)->has(Section::factory(4))->create();
    $this->assertDatabaseCount('spaces', 2);
    $this->assertDatabaseCount('sections', 8);
    $response = $this->get(route('spaces.sections.index', [1]));
    expect($response)->isOk()->and($response->json())->and($response->json('sections'))->toHaveCount(4);
});
it('does not retrieve sections that do not belong to the specified space', function () {

    $spaces = Space::factory(2)->has(Section::factory(4))->create();
    $this->assertDatabaseCount('spaces', 2);
    $this->assertDatabaseCount('sections', 8);
    $sectionIds = Space::find(1)->sections()->get(['id'])->pluck('id');
    $response = $this->get(route('spaces.sections.index', [1]));
    expect($response)->isOk()->and($response->json())->and($response->json('sections'))->toBeArray();
    foreach ($response->json('sections') as $section) {
        expect($section['id'])->toBeIn($sectionIds);
    }
});
