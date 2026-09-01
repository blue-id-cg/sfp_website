<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use App\Models\Concerns\HasUniqueSlug;
use App\Models\Concerns\Publishable;
use Database\Factories\RealisationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'category', 'description', 'image', 'facts', 'tags', 'position', 'published_at'])]
class Realisation extends Model
{
    /** @use HasFactory<RealisationFactory> */
    use HasFactory, HasImageUrl, HasUniqueSlug, Publishable;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'facts' => 'array',
            'tags' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
