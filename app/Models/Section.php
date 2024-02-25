<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{

    protected $guarded = [
        'id',
    ];

    protected $hidden = [];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

}
