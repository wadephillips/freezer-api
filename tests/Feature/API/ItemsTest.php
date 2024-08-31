<?php

use App\Models\Item;

//use function Pest\Laravel\withoutExceptionHandling;
it('shows a list of available items', function () {

    $items = Item::factory()->count(10)->create();
    $indb = Item::count();
    expect($indb)->toBe(10);
    $response = $this->get(config('app.url').'/api/items');
    expect($response->status())->toBeOk();
    expect(count($response->json()))->toEqual(10);
});

it('saves a new item', function () {

    $count = Item::count();
    expect($count)->toBe(0);

    $response = $this->post(route('items.store'), ['name' => 'Hot Pockets', 'description' => 'A big box of goopy melty food things', 'size' => '20 pocket box']);

    expect($response->isOk());
    $json = $response->json();
    expect($json)->toBeArray();
    expect(count($json))->toEqual(6);
    expect($json)->toHaveKey('name', 'Hot Pockets');
    expect($json)->toHaveKey('description', 'A big box of goopy melty food things');
    expect($json)->toHaveKey('size', '20 pocket box');
});

it('requires a name, description, and size to create an item', function ($name, $description, $size) {

    $response = $this->post(route('items.store'), ['name' => $name, 'description' => $description, 'size' => $size], ['Accept' => 'application/json']);
    expect($response->getStatusCode())->toBe(422);

})->with([
    [null, 'A box of delicious burritos', '20 rolls'],
    ['burritos', null, '20 rolls'],
    ['burritos', 'A box of delicious burritos', null],
    [20, 'A box of delicious burritos', '20 rolls'],
    ['burritos', 20, '20 rolls'],
    ['burritos', 'A box of delicious burritos', 20],
]);

it('retrieves a specific Item', function () {

    $item = Item::factory(1)->create(['name' => 'Hot Pockets'])->first();
    $this->assertDatabaseHas('items', ['name' => 'Hot Pockets']);

    $response = $this->get(route('items.show', ['item' => $item->id]));
    $response->assertOk();
    $response->assertJsonIsObject();
    expect($response->json())->toHaveKey('name', 'Hot Pockets');
});
it('updates an item', function () {

    $item = Item::factory(1)->create(['name' => 'Hot Pockets'])->first();
    $this->assertDatabaseHas('items', ['name' => 'Hot Pockets']);

    $response = $this->patch(route('items.update', ['item' => $item->id]), ['name' => 'Hot Pocketzzz']);
    $response->assertOk();
    $response->assertJsonIsObject();
    expect($response->json())->toHaveKey('name', 'Hot Pocketzzz');
});
