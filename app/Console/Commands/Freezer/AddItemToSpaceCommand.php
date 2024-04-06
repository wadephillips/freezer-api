<?php

namespace App\Console\Commands\Freezer;

use App\Models\Item;
use App\Models\Section;
use App\Models\Space;
use Illuminate\Console\Command;

use function Laravel\Prompts\search;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class AddItemToSpaceCommand extends Command
{

    protected $signature = 'freezer:add-item-to-space';

    protected $description = 'Assign Item(s) to a Section of a Space';

    public function handle(): void
    {
        $spaces = Space::select(['id', 'name'])->with(['sections'])->get();
        $spaceChoice = select('Where would you like to store your item?', $spaces->pluck('name', 'id'));
        $space = $spaces[ $spaceChoice - 1 ];

        $sections = $space->sections;
        $sectionChoice = select('Which section does it belong in?', $sections->pluck('name', 'id'));
        $section = $sections[ $sectionChoice - 1 ];

        $item = search(
            "Which item would you like to add to {$space->name} - {$section->name}?",
            fn (string $value) => strlen($value) > 0
                ? Item::where('name', 'like', "%{$value}%")->pluck('name', 'id')->all()
                : []
        );

        $quantity = text('How many?');

        $section->items()->attach($item, ["quantity" => $quantity]);

        //todo resume
    }

}
