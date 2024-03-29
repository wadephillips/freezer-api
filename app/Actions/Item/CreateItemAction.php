<?php

namespace App\Actions\Item;

use App\Models\Item;

class CreateItemAction
{


    public function execute(string $name, string $description, string $size)
    {
        return Item::create(['name' => $name, 'description' => $description, 'size' => $size,]);
    }
}
