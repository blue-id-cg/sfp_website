<?php

namespace App\Support\Content;

/**
 * Contenu d'actualités placeholder, en attendant un modèle persisté.
 *
 * @phpstan-type ActualiteArray array{
 *     slug: string,
 *     category: string,
 *     date: string,
 *     title: string,
 *     excerpt: string,
 *     image: string,
 *     body: string,
 * }
 */
class Actualites
{
    /**
     * @return array<int, array{slug: string, category: string, date: string, title: string, excerpt: string, image: string, body: string}>
     */
    public static function all(): array
    {
        return [
            [
                'slug' => 'lancement-campagne-forage-2026',
                'category' => 'Opérations',
                'date' => '12 mars 2026',
                'title' => 'Lancement d\'une nouvelle campagne de forage',
                'excerpt' => 'La SFP démarre une nouvelle campagne de forage de développement, mobilisant équipes et équipements sur un nouveau site.',
                'image' => 'rig-stairs',
                'body' => '<p class="lead">La Société des Forages Pétroliers a mobilisé ses équipes pour le lancement d\'une nouvelle campagne de forage de développement.</p><p>Cette opération illustre la capacité de la SFP à mobiliser rapidement ses équipements et ses équipes tout en maintenant des standards de sécurité élevés.</p>',
            ],
            [
                'slug' => 'renforcement-culture-hse',
                'category' => 'HSE',
                'date' => '28 février 2026',
                'title' => 'Renforcement de la culture sécurité sur les sites',
                'excerpt' => 'De nouvelles sessions de sensibilisation HSE ont été déployées auprès des équipes techniques sur l\'ensemble des chantiers.',
                'image' => 'crew-platform',
                'body' => '<p class="lead">La sécurité reste la priorité absolue de la SFP. De nouvelles sessions de sensibilisation ont été organisées sur les sites d\'intervention.</p><p>Briefings renforcés, audits réguliers et objectif zéro incident restent au cœur de la démarche HSE de l\'entreprise.</p>',
            ],
            [
                'slug' => 'modernisation-unite-rig-03',
                'category' => 'Innovation',
                'date' => '15 janvier 2026',
                'title' => 'Modernisation de l\'unité mobile RIG #03',
                'excerpt' => 'L\'unité mobile RIG #03 bénéficie d\'une mise à niveau technologique pour renforcer la fiabilité de ses opérations.',
                'image' => 'rig03-unit',
                'body' => '<p class="lead">Dans le cadre de sa stratégie de digitalisation, la SFP a modernisé son unité mobile RIG #03.</p><p>Cette mise à niveau permet un suivi en temps réel des paramètres de forage et une meilleure traçabilité des opérations.</p>',
            ],
        ];
    }

    /**
     * @return array<int, array{slug: string, category: string, date: string, title: string, excerpt: string, image: string, body: string}>
     */
    public static function teaser(int $limit = 3): array
    {
        return array_slice(self::all(), 0, $limit);
    }

    /**
     * @return array{slug: string, category: string, date: string, title: string, excerpt: string, image: string, body: string}|null
     */
    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $actualite) {
            if ($actualite['slug'] === $slug) {
                return $actualite;
            }
        }

        return null;
    }

    /**
     * @return array<int, array{slug: string, category: string, date: string, title: string, excerpt: string, image: string, body: string}>
     */
    public static function others(string $slug, int $limit = 3): array
    {
        return array_values(array_slice(
            array_filter(self::all(), fn (array $actualite) => $actualite['slug'] !== $slug),
            0,
            $limit
        ));
    }
}
