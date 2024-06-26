<?php

use App\Models\Space;

it('has a command for creating a new Space', function () {
    $this->artisan('freezer:make-space Main')->expectsOutput('Main created!');

});
it('returns a collection of spaces', function () {
    Space::factory(10)->create();

    $response = Http::get(config('app.url').'/api/spaces');
    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();
});

it('creates a new Space from a POST request', function () {
    $response = Http::post('/spaces/create', ['name' => 'Garage Freezer',]);

    expect($response->status())->toBe(200);

})->todo();
