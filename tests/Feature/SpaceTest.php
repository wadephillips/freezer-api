<?php

//uses(Illuminate\Support\Facades\Artisan::class);

it('has a command for creating a new Space', function () {
    $this->artisan('freezer:make-space Main')->expectsOutput('Main created!');

});
