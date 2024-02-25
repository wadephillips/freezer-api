<?php

namespace App\Actions\Section;

use App\Models\Section;
use App\Models\Space;

class CreateSectionAction
{
    function execute(string $name, string $description, Space|int $space)
    {
        if ($space instanceof Space) {
            $space = $space->id;
        }
        return Section::create([
            'name' => $name,
            'description' => $description,
            'space_id' => $space,
        ]);
    }
}
