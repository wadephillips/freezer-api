<?php

namespace App\Console\Commands;

use App\Actions\Section\CreateSectionAction;
use App\Models\Space;
use Exception;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class FreezerMakeSectionCommand extends Command
{
    protected $signature = 'freezer:make-section {name?} {description?} {--space-id=}';

    protected $description = 'Command description';

    /**
     * @throws Exception
     */
    public function handle(CreateSectionAction $createSectionAction): void
    {
        //find the space
        try {
            if ($this->option('space-id')) {
                $space = Space::findOrFail($this->option('space-id'));
            } else {
                $spaces = Space::all();
                $space = select('Which space would you like to add a section to?', $spaces->pluck('name', 'id'));
                $space = Space::findOrFail($space);
            }
            //set up a name & description
            $name = $this->argument('name') ?? text('Please name this section'); //set up the description
            $description = $this->argument('description') ?? text('Please provide a description of the section');

            $createSectionAction->execute($name, $description, $space);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            throw $e;
        }
        $this->info($name.' section created!');
    }
}
