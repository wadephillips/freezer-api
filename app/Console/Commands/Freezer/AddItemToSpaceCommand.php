<?php

namespace App\Console\Commands\Freezer;

use App\Actions\AddItemToSectionAction;
use App\Models\Item;
use App\Models\Section;
use App\Models\Space;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\search;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class AddItemToSpaceCommand extends Command
{

    protected $signature = 'freezer:add-item-to-space';

    protected $description = 'Assign Item(s) to a Section of a Space';

    public function handle(AddItemToSectionAction $addItemToSectionAction): void
    {

            $spaces = Space::select(['id', 'name'])->with(['sections'])->get()->keyBy('id');
            $spaceChoice = select('Where would you like to store your item?', $spaces->pluck('name', 'id'));

            $space = $spaces[$spaceChoice];
            $sections = $space->sections->keyBy('id');
            $sectionChoice = select('Which section does it belong in?', $sections->pluck('name', 'id'));
            $section = $sections[ $sectionChoice ];
        do {
            $itemSelection = search(
                "Which item would you like to add to {$space->name} - {$section->name}?",
                fn(string $value) => strlen($value) > 0 ? Item::where('name', 'like', "%{$value}%")->pluck(
                    'name',
                    'id'
                )->all() : []
            );
            $item = Item::find($itemSelection);
            $quantity = text('How many?');

            info("{$quantity} of {$item->name} have been added to {$space->name} - {$section->name}");

            $addItemToSectionAction->execute($item, $section, $quantity);//todo resume
            $rerun = confirm("Would you like to add another item to {$space->name} - {$section->name}");

        } while ($rerun);
    }

}
