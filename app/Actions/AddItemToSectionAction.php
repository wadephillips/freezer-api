<?php

namespace App\Actions;

use App\Models\Item;
use App\Models\Section;

class AddItemToSectionAction
{

    public function execute(Item $item, Section $section, int $quantity)
    {

        return $section->items()->attach($item, ["quantity" => $quantity]);

    }
}
