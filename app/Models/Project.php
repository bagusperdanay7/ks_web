<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\PlaylistProject;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Eager loading menangani masalah n+1
    protected $with = ['category', 'projectType', 'artists'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return  $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['type'] ?? false, function ($query, $type) {
            return $query->whereHas('projectType', function ($query) use ($type) {
                $query->where('slug', $type);
            });
        });
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'project_artist')->using(ProjectArtist::class)->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class)->using(PlaylistProject::class)->withPivot('order', 'main_video')->withTimestamps();
    }
}
