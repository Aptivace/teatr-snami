<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Spectacle extends Model
{
    //
    protected $casts = [
        'images' => 'array',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Spectacle::class, 'spectacles_members', 'spectacle_id', 'member_id');
    }
}
