<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Space extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $visible = [];

    public function sections(): HasMany
    {

        return $this->hasMany(Section::class);
    }

}
