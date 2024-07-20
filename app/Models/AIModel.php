<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AIModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['artist'];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
