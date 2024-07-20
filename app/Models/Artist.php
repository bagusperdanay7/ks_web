<?php

namespace App\Models;

use App\Enums\ArtistClassification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'classification' => ArtistClassification::class
    ];

    protected $with = ['company'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_artist')->using(ProjectArtist::class)->withTimestamps();
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)->using(AlbumArtist::class)->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function idol(): HasOne
    {
        return $this->hasOne(Idol::class);
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_artist')->using(SongArtist::class)->withPivot('role')->withTimestamps();
    }

    public function aimodels(): HasMany
    {
        return $this->hasMany(AIModel::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Idol::class, 'member_group')->using(MemberGroup::class)->withPivot('status')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'codename';
    }
}
