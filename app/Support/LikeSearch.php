<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;

class LikeSearch
{
    public static function apply(Builder $query, string $column, string $search): Builder
    {
        $escaped = str_replace(
            ['!', '%', '_'],
            ['!!', '!%', '!_'],
            $search,
        );

        return $query->whereRaw("{$column} LIKE ? ESCAPE '!'", ["%{$escaped}%"]);
    }
}
