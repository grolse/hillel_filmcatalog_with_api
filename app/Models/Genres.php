<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genres extends Model
{
    protected $fillable = ['name'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movies::class);
    }
}
