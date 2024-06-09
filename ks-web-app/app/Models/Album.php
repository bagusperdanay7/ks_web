<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Album extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class)->using(AlbumSong::class)->withPivot('id', 'track_number', 'category')->withTimestamps()->orderByPivot('track_number', 'asc');
    }
}
