<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spectacle extends Model
{
    //
    protected $casts = [
        'images' => 'array',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'spectacles_members', 'spectacle_id', 'member_id');
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(Reward::class, 'spectacle_id', 'id');
    }

    public function afishes(): HasMany
    {
        return $this->hasMany(Afisha::class, 'spectacle_id', 'id');

    }
}
