<?php

namespace App\Models;

use Database\Factories\ContentBlockFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A single icon+title+description card belonging to a named, repeated group (e.g. "hse_metrics",
 * "trades", "instruments") reused across one or more public pages.
 */
#[Fillable(['group', 'icon', 'title', 'description', 'meta', 'position'])]
class ContentBlock extends Model
{
    /** @use HasFactory<ContentBlockFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }

    /**
     * @param  Builder<ContentBlock>  $query
     * @return Builder<ContentBlock>
     */
    public function scopeGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }

    /**
     * Human-friendly label for a group slug, shown in the admin instead of the raw identifier.
     * This is the fixed, canonical list of groups a public page actually queries — not derived
     * from the database — so admins pick from it instead of typing (and risking a typo that
     * would silently create a group no page ever reads).
     *
     * @var array<string, string>
     */
    public const GROUP_LABELS = [
        'trades' => 'Métiers — nos savoir-faire',
        'instruments' => 'Accueil & Métiers — technologie',
        'hse_metrics' => 'Accueil & HSE — indicateurs sécurité',
        'hse_method' => 'HSE — notre méthode',
        'about_expertise' => "À propos — domaines d'expertise",
        'about_pillars' => 'À propos — vision, mission, objectifs',
        'about_values' => 'À propos — nos valeurs',
        'home_ent_values' => 'Accueil — nos valeurs (teaser)',
        'equipements_perks' => 'Équipements — atouts de la base',
        'equipment_specs' => 'Accueil — fiches techniques appareils',
    ];

    /**
     * Curated, verified-to-exist Hugeicons stroke-rounded classes offered in the admin icon
     * picker, grouped by theme. Admins pick one instead of typing a class name from scratch —
     * typing let an invalid class (e.g. the "hgi-square-01" that used to sit in the admin nav)
     * through silently, since a missing glyph fails visually, not with an error.
     *
     * @var array<string, list<string>>
     */
    public const ICON_PALETTE = [
        'Sécurité & HSE' => ['hgi-vest', 'hgi-shield-01', 'hgi-safety-pin-01', 'hgi-alert-01', 'hgi-alert-02', 'hgi-fire', 'hgi-tick-01', 'hgi-glove', 'hgi-mask'],
        'Industrie & forage' => ['hgi-factory-01', 'hgi-oil-barrel', 'hgi-warehouse', 'hgi-hard-drive', 'hgi-cpu', 'hgi-truck', 'hgi-delivery-truck-01', 'hgi-battery-charging-01', 'hgi-thermometer', 'hgi-droplet', 'hgi-water-pump'],
        'Outils & réglages' => ['hgi-settings-01', 'hgi-settings-02', 'hgi-tools', 'hgi-wrench-01', 'hgi-filter', 'hgi-refresh', 'hgi-key-01'],
        'Données & suivi' => ['hgi-chart-line-data-01', 'hgi-clipboard', 'hgi-search-01', 'hgi-focus-point', 'hgi-dashboard-speed-01', 'hgi-dashboard-square-01', 'hgi-target-01', 'hgi-timer-01', 'hgi-time-quarter-pass', 'hgi-connect'],
        'Équipe & valeurs' => ['hgi-user-group', 'hgi-agreement-01', 'hgi-graduation-scroll', 'hgi-headset', 'hgi-call-02', 'hgi-idea-01', 'hgi-medal-01', 'hgi-award-01', 'hgi-star', 'hgi-compass-01', 'hgi-flag-01'],
        'Environnement & lieux' => ['hgi-leaf-01', 'hgi-recycle-01', 'hgi-globe-02', 'hgi-location-01', 'hgi-map-pinpoint-01', 'hgi-book-01', 'hgi-calendar-01', 'hgi-lock', 'hgi-rocket-01', 'hgi-layers-01'],
    ];

    public static function groupLabel(string $group): string
    {
        return self::GROUP_LABELS[$group] ?? $group;
    }

    /**
     * Every icon class offered by the picker, flattened for validation.
     *
     * @return array<int, string>
     */
    public static function iconChoices(): array
    {
        return array_merge(...array_values(self::ICON_PALETTE));
    }
}
