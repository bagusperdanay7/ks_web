<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function albums() {
        return $this->hasMany(Album::class);
    }
}
