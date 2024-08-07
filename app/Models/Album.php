<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['publisher'];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->using(AlbumArtist::class)->withTimestamps();
    }
}
