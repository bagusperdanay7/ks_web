<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idol extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['artist'];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'member_group')->using(MemberGroup::class)->withPivot('status')->withTimestamps();
    }
}
