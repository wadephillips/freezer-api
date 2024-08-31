<?php

use App\Models\Item;

//use function Pest\Laravel\withoutExceptionHandling;
it('shows a list of available items', function () {

    $items = Item::factory()->count(10)->create();
    $indb = Item::count();
    expect($indb)->toBe(10);
    $response = $this->get(config('app.url') . '/api/items');
    expect($response->status())->toBeOk();
    expect(count($response->json()))->toEqual(10);

});
