<?php

namespace App\Actions\Space;

use App\Models\Space;

class CreateSpaceAction
{
    public function execute(string $name): Space
    {
        return Space::create(['name' => $name]);
    }
}
