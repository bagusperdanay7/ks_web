<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getRouteKeyName()
    {
        return 'codename';
    }
}
