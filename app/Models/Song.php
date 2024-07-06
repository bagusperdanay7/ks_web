<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)->using(SongGenre::class)->withTimestamps();
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->using(Collaboration::class)->withPivot('role')->withTimestamps();
    }

    public function writers(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->using(Songwriter::class)->withPivot('role')->withTimestamps();
    }
}
