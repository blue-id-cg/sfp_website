<?php

namespace App\Models;

use Database\Factories\ActualiteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'category', 'excerpt', 'body', 'image', 'published_at'])]
class Actualite extends Model
{
    /** @use HasFactory<ActualiteFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $suffix = 2;

        while (static::query()->where('slug', $slug)->when($ignoreId, fn (Builder $query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    /**
     * @param  Builder<Actualite>  $query
     * @return Builder<Actualite>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(get: function () {
            if (! $this->image) {
                return null;
            }

            return str_contains($this->image, '/')
                ? Storage::disk('public')->url($this->image)
                : asset('images/opt/'.$this->image.'.jpg');
        });
    }

    protected function bodyHtml(): Attribute
    {
        return Attribute::make(get: fn () => Str::markdown($this->body ?? ''));
    }

    protected function dateLabel(): Attribute
    {
        return Attribute::make(get: fn () => $this->published_at?->translatedFormat('d F Y'));
    }
}
