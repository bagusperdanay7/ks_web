<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Eager loading menangani masalah n+1
    protected $with = ['artist', 'category'];

    public function scopeFilter($query, array $filters)
    {

        // TODO: Nanti tambahkan ['project_status', 'Completed'] atau di viewnya tuliskan keterangan saja, project ini sedang dikerjakan
        // null
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return  $query->where(function ($query) use ($search) {
                $query->where('project_title', 'like', '%' . $search . '%');
                // ->orWhere('project_types.type_name', 'like', '%' . $search . '%');
            });
        });


        // callback
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        // arrow function
        $query->when($filters['artist'] ?? false, fn ($query, $artist) => $query->whereHas('artist', fn ($query) => $query->where('codename', $artist)));
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(ProjectType::class);
    }
}
