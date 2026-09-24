<?php

namespace App\Models;

use App\Models\Concerns\HasUniqueSlug;
use App\Support\HtmlSanitizer;
use Database\Factories\TradeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'icon', 'description', 'body', 'position'])]
class Trade extends Model
{
    /** @use HasFactory<TradeFactory> */
    use HasFactory, HasUniqueSlug;

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
}
