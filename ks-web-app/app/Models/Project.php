<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Eager loading menangani masalah n+1
    protected $with = ['artist', 'category', 'type'];

    public function scopeFilter($query, array $filters)
    {
        // null
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return  $query->where(function ($query) use ($search) {
                $query->where('project_title', 'like', '%' . $search . '%');
            });
        });

        // callback
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['type'] ?? false, function ($query, $type) {
            return $query->whereHas('type', function ($query) use ($type) {
                $query->where('slug', $type);
            });
        });
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }
}
