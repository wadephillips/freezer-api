<?php

uses( Illuminate\Support\Facades\Artisan::class);

it('has a command for creating a new Space', function () {
    $response = Artisan::call("freezer:make-space");

    $this->assertContains('beer', $response);
});
