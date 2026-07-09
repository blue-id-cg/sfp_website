<?php

namespace Database\Seeders;

use App\Models\Offre;
use Illuminate\Database\Seeder;

class OffresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offres = [
            [
                'slug' => 'ingenieur-forage',
                'title' => 'Ingénieur forage',
                'tags' => ['Brazzaville', 'CDI', 'Forage'],
                'summary' => 'Piloter les opérations de forage sur site, garantir la sécurité des équipes et la performance technique des puits.',
                'missions' => [
                    'Superviser les opérations de forage en conformité avec les procédures HSE',
                    'Analyser les paramètres de forage en temps réel',
                    'Coordonner les équipes techniques sur site',
                ],
                'profile' => [
                    "Formation d'ingénieur en forage ou pétrole",
                    'Expérience significative en opérations de forage',
                    "Rigueur, esprit d'équipe et culture sécurité",
                ],
                'published_at' => now(),
            ],
            [
                'slug' => 'technicien-mud-logging',
                'title' => 'Technicien mud logging',
                'tags' => ['Site', 'CDD', 'Mud Logging'],
                'summary' => "Assurer le suivi géologique et l'analyse des données de forage en temps réel.",
                'missions' => [
                    'Suivre les paramètres géologiques et de forage',
                    "Produire des rapports quotidiens d'opération",
                    "Alerter les équipes en cas d'anomalie",
                ],
                'profile' => [
                    'Formation technique en géosciences ou équivalent',
                    'Expérience en mud logging appréciée',
                    'Capacité à travailler en rotation sur site',
                ],
                'published_at' => now(),
            ],
        ];

        foreach ($offres as $offre) {
            Offre::query()->updateOrCreate(['slug' => $offre['slug']], $offre);
        }
    }
}
