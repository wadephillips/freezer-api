<?php

namespace App\Console\Commands;

use App\Actions\Space\CreateSpaceAction;
use Illuminate\Console\Command;

class FreezerMakeSpaceCommand extends Command
{
  protected $signature = 'freezer:make-space {name}';

  protected $description = 'Creates a new space for storing food, this could represent a freezer, refrigerator, or cooler';

  public function handle(CreateSpaceAction $createSpaceAction): void
  {
      $name = $this->argument('name');
      $createSpaceAction->execute($name);
      $this->info("{$name} created!");
  }
}
