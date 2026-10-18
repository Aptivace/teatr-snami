<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Afisha extends Model
{
    //

    protected $casts = [
        'date' => 'date',
    ];

    public function spectacle(): BelongsTo
    {
        return $this->belongsTo(Spectacle::class);
    }
}
