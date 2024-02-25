<?php

use App\Models\Space;

it('creates a section', function () {

    $space = Space::factory()->create();
    $this->artisan('freezer:make-section', ['name' => 'LL', 'description' => 'The Lower Left', '--space-id' => $space->id])->expectsOutput('LL section created!');
});

it('asks for a name', function () {
    $space = Space::factory()->create();
    $this->artisan('freezer:make-section', ['description' => 'the lower left third', '--space-id' => $space->id])->expectsQuestion('Please name this section', 'LL')
        ->assertExitCode(0);
});

it('asks for a description', function () {
    $space = Space::factory()->create();
    $this->artisan('freezer:make-section', ['name' => 'LL', '--space-id' => $space->id])->expectsQuestion('Please provide a description of the section', 'The lower left third')
        ->assertExitCode(0);
});

it('asks to select a space', function () {
    $spaces = Space::factory(2)->create();
    $ids = $spaces->pluck('name', 'id');
    $this->artisan('freezer:make-section', ['name' => 'LL', 'description' => 'The Lower Left'])
        ->expectsQuestion('Which space would you like to add a section to?', $spaces[1]->id)
        ->assertExitCode(0);
});
