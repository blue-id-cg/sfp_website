<?php

namespace App\Models;

use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * One row per public page (see config/pages.php for the fixed set of slugs and the schema of
 * editable text fields each one exposes in the admin). Section text not covered here — repeating
 * cards and site-wide settings — lives in ContentBlock and SiteSetting instead.
 */
#[Fillable(['slug', 'content'])]
class Page extends Model
{
    /** @use HasFactory<PageFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get a value from this page's content by "section.field" dot path.
     */
    public function get(string $path, ?string $default = null): ?string
    {
        return data_get($this->content, $path, $default);
    }
}
