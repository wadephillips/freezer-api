<?php

it('creates an item', function () {

    $this->artisan('freezer:make-item')
        ->expectsQuestion('Please provide a name', 'Ground Beef')
        ->expectsQuestion('Please provide a description', 'A package of burger meat for cooking')
        ->expectsQuestion('Please provide a package size', '1# package')
        ->expectsOutput("Ground Beef - 1# package added to item list")
    ->expectsConfirmation('Would you like to create another item?' );
});
