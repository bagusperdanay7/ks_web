<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)->using(AlbumSong::class)->withPivot('id', 'track_number', 'category')->withTimestamps();
    }
}
