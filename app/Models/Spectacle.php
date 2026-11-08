<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spectacle extends Model
{
    //
    protected $casts = [
        'images' => 'array',
    ];


    protected function durationText(): Attribute
    {
        return Attribute::get(function () {
            $total = (int) $this->duration;

            if ($total <= 0) {
                return '';
            }

            $hours = intdiv($total, 60);
            $minutes = $total % 60;

            $parts = [];

            if ($hours > 0) {
                $parts[] = $hours . ' ' . self::plural($hours, 'час', 'часа', 'часов');
            }

            if ($minutes > 0) {
                $parts[] = $minutes . ' ' . self::plural($minutes, 'минута', 'минуты', 'минут');
            }

            return implode(' ', $parts);
        });
    }


    private static function plural(int $n, string $one, string $few, string $many): string
    {
        $n = abs($n) % 100;
        $last = $n % 10;

        if ($n > 10 && $n < 20) return $many;
        if ($last === 1) return $one;
        if ($last >= 2 && $last <= 4) return $few;

        return $many;
    }

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
