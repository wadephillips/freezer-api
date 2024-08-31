<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [];

    protected function section(): BelongsToMany
    {

        return $this->belongsToMany(Section::class, 'space_items');
    }
}
