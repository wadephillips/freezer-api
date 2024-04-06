<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{

    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [];

    protected function section(): BelongsTo
    {

        return $this->belongsToMany(Section::class, 'space_items');
    }

}
