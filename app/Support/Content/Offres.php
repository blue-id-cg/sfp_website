<?php

namespace App\Support\Content;

/**
 * Offres d'emploi placeholder, en attendant un modèle persisté.
 */
class Offres
{
    /**
     * @return array<int, array{slug: string, title: string, tags: array<int, string>, summary: string, missions: array<int, string>, profile: array<int, string>}>
     */
    public static function all(): array
    {
        return [
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
                    'Rigueur, esprit d\'équipe et culture sécurité',
                ],
            ],
            [
                'slug' => 'technicien-mud-logging',
                'title' => 'Technicien mud logging',
                'tags' => ['Site', 'CDD', 'Mud Logging'],
                'summary' => "Assurer le suivi géologique et l'analyse des données de forage en temps réel.",
                'missions' => [
                    'Suivre les paramètres géologiques et de forage',
                    'Produire des rapports quotidiens d\'opération',
                    "Alerter les équipes en cas d'anomalie",
                ],
                'profile' => [
                    'Formation technique en géosciences ou équivalent',
                    'Expérience en mud logging appréciée',
                    'Capacité à travailler en rotation sur site',
                ],
            ],
        ];
    }

    /**
     * @return array{slug: string, title: string, tags: array<int, string>, summary: string, missions: array<int, string>, profile: array<int, string>}|null
     */
    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $offre) {
            if ($offre['slug'] === $slug) {
                return $offre;
            }
        }

        return null;
    }
}
