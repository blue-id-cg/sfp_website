<?php

namespace App\Models;

use Database\Factories\SiteSettingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Single-row table holding site-wide settings (contact details, key figures) that would
 * otherwise be duplicated across several pages.
 */
#[Fillable(['contact_address', 'contact_phone', 'contact_email', 'founding_year', 'rigs_count', 'incidents_count'])]
class SiteSetting extends Model
{
    /** @use HasFactory<SiteSettingFactory> */
    use HasFactory;

    /**
     * Get the single settings row, creating it with empty defaults if it doesn't exist yet.
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate([]);
    }
}
