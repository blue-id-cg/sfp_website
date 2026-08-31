<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use App\Models\Concerns\HasUniqueSlug;
use App\Models\Concerns\Publishable;
use App\Support\HtmlSanitizer;
use Database\Factories\ActualiteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'category', 'excerpt', 'body', 'image', 'published_at'])]
class Actualite extends Model
{
    /** @use HasFactory<ActualiteFactory> */
    use HasFactory, HasImageUrl, HasUniqueSlug, Publishable;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * The body is rich text authored via the admin editor. It is sanitized against an
     * allow-list on write, so it can be rendered as trusted HTML anywhere it's read.
     */
    protected function body(): Attribute
    {
        return Attribute::make(set: fn (?string $value) => (new HtmlSanitizer)->clean($value ?? ''));
    }

    protected function bodyHtml(): Attribute
    {
        return Attribute::make(get: fn () => $this->body ?? '');
    }

    protected function dateLabel(): Attribute
    {
        return Attribute::make(get: fn () => $this->published_at?->translatedFormat('d F Y'));
    }
}
