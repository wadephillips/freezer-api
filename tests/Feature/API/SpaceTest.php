<?php

use App\Models\Space;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use function Pest\Laravel\withoutExceptionHandling;

it('has a command for creating a new Space', function () {
    $this->artisan('freezer:make-space Main')->expectsOutput('Main created!');

});
it('returns a collection of spaces', function () {
    Space::factory(10)->create();

    $response = Http::get(config('app.url').'/api/spaces');
    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();
    $dbCount = Space::count('id');
    expect($dbCount)->toEqual(10);
});

it('creates a new Space from a POST request', function () {

    $response = Http::post(config('app.url').'/api/spaces', ['name' => 'Garage Freezer',]);
    expect($response->status())->toBe(200);
    $spaces = Space::count();
    expect($spaces)->toEqual(1);

});

it('gets a Space with a GET request', function () {
    $response = Http::get(config('app.url') . '/api/spaces/1');
    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();
    //dd($response->json());
    expect($response->json()['data']['name'])->toBe('Garage Freezer');
});
