<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use App\Models\Concerns\HasUniqueSlug;
use App\Support\HtmlSanitizer;
use Database\Factories\EquipmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['title', 'slug', 'description', 'body', 'image', 'spec_sheet', 'position'])]
class Equipment extends Model
{
    /** @use HasFactory<EquipmentFactory> */
    use HasFactory, HasImageUrl, HasUniqueSlug;

    /**
     * @return BelongsToMany<Trade, $this>
     */
    public function trades(): BelongsToMany
    {
        return $this->belongsToMany(Trade::class);
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

    protected function specSheetUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->spec_sheet ? Storage::disk('public')->url($this->spec_sheet) : null);
    }
}
