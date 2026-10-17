<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    //
    public function spectacles(): BelongsToMany
    {
        return $this->belongsToMany(Spectacle::class, 'spectacles_members', 'member_id', 'spectacle_id');
    }
}
