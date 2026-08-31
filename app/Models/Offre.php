<?php

namespace App\Models;

use App\Models\Concerns\HasUniqueSlug;
use App\Models\Concerns\Publishable;
use Database\Factories\OffreFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'tags', 'summary', 'missions', 'profile', 'published_at'])]
class Offre extends Model
{
    /** @use HasFactory<OffreFactory> */
    use HasFactory, HasUniqueSlug, Publishable;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'missions' => 'array',
            'profile' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
