<?php

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
        ->expectsChoice('Where would you like to store your item?', 1, $spaces->pluck('name','id'))
        ->expectsChoice('Which section does it belong in?', 1, $sections->pluck('name', 'id'))
        ->expectsQuestion("Which item would you like to add to {$space->name} - {$section->name}?", $item->name)
        ->expectsChoice("Which item would you like to add to {$space->name} - {$section->name}?", $item->name, $items->pluck('name', 'id'))
        ->expectQuestion("How many?", 5)
        ->expectsOutput("5 of {$item->name} have been added to {$space->name} - {$section->name}");
        //->expectsConfirmation("Would you like to add another item to {$space->name} - {$section->name}");
    //expect
    todo('expect to see some db tests');//todo resume I think we're good up to here need to add some db tests that show that the association has been made
});
