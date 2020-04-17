<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movies extends Model
{
    protected $fillable = [
        'title',
        'release',
        'plot',
        'runtime',
        'poster',
        'country',
        'imdb_id'
    ];
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actors::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class);
    }

    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Directors::class);
    }
}
