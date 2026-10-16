<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spectacle extends Model
{
    //
    protected $casts = [
        'images' => 'array',
    ];
}
