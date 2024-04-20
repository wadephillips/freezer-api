<?php

use App\Actions\AddItemToSectionAction;
use App\Models\Item;
use App\Models\Section;
use App\Models\Space;

it('adds an item to a space', function () {

    //given
    $spaces = Space::factory(2)->create();
    $space = $spaces->first();
    $sections = Section::factory(2)->create(['space_id' => $space->id,]);
    $section = $sections->first();
    $items = Item::factory(5)->create();
    $item = $items->first();
    //do command
    $this->artisan('freezer:add-item-to-space')
        ->expectsChoice('Where would you like to store your item?', 1, $spaces->pluck('name','id')->toArray())
        ->expectsChoice('Which section does it belong in?', 1, $sections->pluck('name', 'id')->toArray())
        ->expectsQuestion("Which item would you like to add to {$space->name} - {$section->name}?", $item->name)
        ->expectsChoice("Which item would you like to add to {$space->name} - {$section->name}?", $items->pluck('name', 'id')->toArray()[$item->id], $items->pluck('name', 'id')->toArray())//todo getting error this returns a string which fails below, but if I answer with a number I get err : Question "..." has different options. Failed asserting that two arrays are equal.
        ->expectsQuestion("How many?", 5)
        ->expectsOutput("5 of {$item->name} have been added to {$space->name} - {$section->name}")
        ->expectsQuestion("Would you like to add another item to {$space->name} - {$section->name}", (bool)false);
    //expect

    //$this->assertDatabaseCount('section_items', 1);
    //$this->assertDatabaseHas('section_items', ['section_id' => $section->id, 'item_id' => $item->id, 'quantitiy' => 5,]);
    todo('expect to see some db tests');//todo
})->todo();

it('displays a list of items in a space', function () {

    $spaces = Space::factory(2)->create();
    $space = $spaces->first();
    $sections = Section::factory(2)->create(['space_id' => $space->id,]);
    $section = $sections->first();
    $items = Item::factory(1)->create();
    $j = 1;
    $action = new AddItemToSectionAction();
    $items->each(fn($i) => $action->execute($i, $section, $j++));

    $storedItems = $section->items()->get()->map(function (Item $item) {

        return [$item->name, $item->pivot->quantity, $item->description];
    });

    $this->artisan('freezer:show-space')
        ->expectsChoice('Which space would you like to see?', 1, $spaces->pluck('name','id')->toArray())
        ->expectsOutputToContain($section->name)
        ->expectsTable(['Name', 'Quantity', 'Description'], $storedItems)// todo make this work with Prompts table
    ;
});
