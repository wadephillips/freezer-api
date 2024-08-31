<?php

namespace App\Actions\Space;

use App\Models\Space;

class UpdateSpaceAction
{
    public function execute(Space $space, array $input)
    {
        return $space->update($input);
    }
}
