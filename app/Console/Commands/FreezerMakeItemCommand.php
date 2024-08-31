<?php

namespace App\Console\Commands;

use App\Actions\Item\CreateItemAction;
use Exception;
use Illuminate\Console\Command;

class FreezerMakeItemCommand extends Command
{
    protected $signature = 'freezer:make-item {name?} {description?}';

    protected $description = 'Create an item for storing';

    public function handle(CreateItemAction $createItemAction): void
    {

        do {
            try {
                $name = $this->argument('name') ?? $this->ask('Please provide a name');
                $description = $this->argument('description') ?? $this->ask('Please provide a description');
                $packageSize = $this->ask('Please provide a package size');
                $item = $createItemAction->execute($name, $description, $packageSize);
            } catch (Exception $e) {
                $this->error($e->getMessage());
                throw $e;
            }
            $this->info("{$item->name} - {$item->size} added to item list");
            $reRun = $this->confirm('Would you like to create another item?');
        } while ($reRun);
    }
}
