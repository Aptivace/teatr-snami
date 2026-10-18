<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reviews extends Model
{
    //
    public function spectacle(): BelongsTo
    {
        return $this->belongsTo(Spectacle::class);
    }
}
