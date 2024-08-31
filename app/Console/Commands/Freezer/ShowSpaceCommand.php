<?php

namespace App\Console\Commands\Freezer;

use App\Models\Item;
use App\Models\Space;
use Illuminate\Console\Command;

use function Laravel\Prompts\info;
use function Laravel\Prompts\select;

class ShowSpaceCommand extends Command
{
    protected $signature = 'freezer:show-space';

    protected $description = 'Show a table for each section with a listing of all the items in the space';

    public function handle(): void
    {
        $spaces = Space::select(['id', 'name'])->with(['sections'])->get()->keyBy('id');
        $spaceChoice = select('Which space would you like to see?', $spaces->pluck('name', 'id'));

        $space = Space::find($spaceChoice)->load('sections.items');
        foreach ($space->sections as $section) {
            info($section->name);
            $items = $section->items->map(function (Item $item) {

                return ['name' => $item->name, 'quantity' => $item->pivot->quantity, 'description' => $item->description];
            });

            $this->table(['Name', 'Quantity', 'Description'], $items);
        }
    }
}
