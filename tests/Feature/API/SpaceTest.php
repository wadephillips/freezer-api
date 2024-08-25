<?php

use App\Models\Space;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\withoutExceptionHandling;

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
    expect($response->json()['data']['name'])->toBe('Garage Freezer');
});

it('deletes a Space with a GET request', function () {
    $before = Space::count(); //causing Http request to time out??
    //expect($before)->toEqual(1);
    $response = Http::delete(config('app.url'). '/api/spaces/1');
    expect($response->status())->toBe(204);
    $spaces = Space::count();
    expect($spaces)->toEqual(0);
});
