<?php

namespace Database\Seeders;

use App\Models\Actualite;
use Illuminate\Database\Seeder;

class ActualitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actualites = [
            [
                'slug' => 'lancement-campagne-forage-2026',
                'category' => 'Opérations',
                'published_at' => '2026-03-12',
                'title' => "Lancement d'une nouvelle campagne de forage",
                'excerpt' => 'La SFP démarre une nouvelle campagne de forage de développement, mobilisant équipes et équipements sur un nouveau site.',
                'image' => 'rig-stairs',
                'body' => "La Société des Forages Pétroliers a mobilisé ses équipes pour le lancement d'une nouvelle campagne de forage de développement.\n\nCette opération illustre la capacité de la SFP à mobiliser rapidement ses équipements et ses équipes tout en maintenant des standards de sécurité élevés.",
            ],
            [
                'slug' => 'renforcement-culture-hse',
                'category' => 'HSE',
                'published_at' => '2026-02-28',
                'title' => 'Renforcement de la culture sécurité sur les sites',
                'excerpt' => "De nouvelles sessions de sensibilisation HSE ont été déployées auprès des équipes techniques sur l'ensemble des chantiers.",
                'image' => 'crew-platform',
                'body' => "La sécurité reste la priorité absolue de la SFP. De nouvelles sessions de sensibilisation ont été organisées sur les sites d'intervention.\n\nBriefings renforcés, audits réguliers et objectif zéro incident restent au cœur de la démarche HSE de l'entreprise.",
            ],
            [
                'slug' => 'modernisation-unite-rig-03',
                'category' => 'Innovation',
                'published_at' => '2026-01-15',
                'title' => "Modernisation de l'unité mobile RIG #03",
                'excerpt' => "L'unité mobile RIG #03 bénéficie d'une mise à niveau technologique pour renforcer la fiabilité de ses opérations.",
                'image' => 'rig03-unit',
                'body' => "Dans le cadre de sa stratégie de digitalisation, la SFP a modernisé son unité mobile RIG #03.\n\nCette mise à niveau permet un suivi en temps réel des paramètres de forage et une meilleure traçabilité des opérations.",
            ],
        ];

        foreach ($actualites as $actualite) {
            Actualite::query()->updateOrCreate(['slug' => $actualite['slug']], $actualite);
        }
    }
}
