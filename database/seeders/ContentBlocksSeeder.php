<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Seeder;

class ContentBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the repeating icon+title+description card lists
     * currently hardcoded in resources/views/metiers/index.blade.php, hse/index.blade.php,
     * about/index.blade.php and equipements/index.blade.php, so Phase 2 can read them from
     * here instead (and, for the groups duplicated across pages, from a single source).
     */
    public function run(): void
    {
        $this->seedGroup('trades', [
            ['icon' => 'hgi-factory-01', 'title' => 'Forage pétrolier', 'description' => "Réalisation de puits d'exploration, d'évaluation et de production, avec des protocoles de sécurité stricts et un pilotage précis des paramètres."],
            ['icon' => 'hgi-layers-01', 'title' => 'Complétion', 'description' => 'Équipement et mise en production des puits pour garantir un débit optimal, durable et conforme aux exigences du réservoir.'],
            ['icon' => 'hgi-refresh', 'title' => 'Work Over', 'description' => 'Reprise, réparation et amélioration des performances des puits existants pour prolonger leur durée de vie et leur productivité.'],
            ['icon' => 'hgi-chart-line-data-01', 'title' => 'Mud Logging', 'description' => 'Suivi géologique en temps réel et analyse des données de forage pour une prise de décision éclairée à chaque phase.'],
            ['icon' => 'hgi-filter', 'title' => 'Pompage & Filtration', 'description' => 'Gestion complète des fluides techniques · du pompage à la filtration · pour des opérations propres, stables et efficaces.'],
            ['icon' => 'hgi-settings-02', 'title' => 'Casing & Tubing', 'description' => 'Descente et vissage de casing et de tubing sur les puits en cours de forage ou de complétion.'],
        ]);

        $this->seedGroup('instruments', [
            ['icon' => 'hgi-dashboard-speed-01', 'title' => 'Surveillance en temps réel', 'description' => 'Contrôle continu des paramètres de forage pour des décisions rapides et sûres.'],
            ['icon' => 'hgi-cpu', 'title' => 'Digitalisation des opérations', 'description' => 'Systèmes connectés pour gagner en efficacité, en traçabilité et en fiabilité.'],
            ['icon' => 'hgi-focus-point', 'title' => 'Optimisation par la donnée', 'description' => "Amélioration continue des performances fondée sur l'analyse des indicateurs."],
        ]);

        $this->seedGroup('hse_metrics', [
            ['icon' => 'hgi-vest', 'title' => 'EPI', 'description' => "Obligatoires sur l'ensemble des sites d'intervention"],
            ['icon' => 'hgi-user-group', 'title' => 'Briefing', 'description' => 'Point sécurité systématique avant chaque opération'],
            ['icon' => 'hgi-clipboard', 'title' => 'Audits', 'description' => 'Contrôles et bonnes pratiques régulièrement vérifiés'],
            ['icon' => 'hgi-shield-01', 'title' => 'Zéro', 'description' => 'Objectif zéro incident, non négociable'],
        ]);

        $this->seedGroup('hse_method', [
            ['icon' => 'hgi-search-01', 'title' => 'Analyse des risques', 'description' => 'Identification et traitement des dangers avant chaque opération.'],
            ['icon' => 'hgi-graduation-scroll', 'title' => 'Formation continue', 'description' => 'Sensibilisation régulière des équipes aux bonnes pratiques HSE.'],
            ['icon' => 'hgi-leaf-01', 'title' => 'Impact environnemental', 'description' => 'Gestion responsable des déchets et des ressources sur chaque site.'],
        ]);

        $this->seedGroup('about_expertise', [
            ['icon' => 'hgi-factory-01', 'title' => 'Forage', 'description' => 'Conduite d\'opérations de forage onshore, de la mobilisation à la finalisation du puits.'],
            ['icon' => 'hgi-layers-01', 'title' => 'Complétion', 'description' => 'Mise en production des puits dans le respect des standards techniques et de sécurité.'],
            ['icon' => 'hgi-refresh', 'title' => 'Work over', 'description' => 'Interventions de reprise et de réhabilitation sur puits existants (ZNG-1D, ZNG-4D, ZNG-3D…).'],
            ['icon' => 'hgi-chart-line-data-01', 'title' => 'Mud logging', 'description' => 'Suivi géologique et analyse en temps réel des paramètres de forage.'],
            ['icon' => 'hgi-dashboard-speed-01', 'title' => 'CTR', 'description' => 'Services de contrôle et de suivi technique des opérations de forage.'],
            ['icon' => 'hgi-filter', 'title' => 'Pompage & filtration', 'description' => 'Gestion complète des fluides de forage, du pompage à la filtration.'],
        ]);

        $this->seedGroup('about_pillars', [
            ['icon' => 'hgi-compass-01', 'title' => 'Devenir un leader du forage', 'description' => 'Être un leader des métiers du forage et des services.', 'meta' => ['label' => 'Vision']],
            ['icon' => 'hgi-target-01', 'title' => "Faire grandir l'expertise congolaise", 'description' => 'Accompagner la SNPC dans le développement de ses actifs opérés et gagner des parts de marché hors groupe SNPC, dans le forage et les services, pour accroître nos performances.', 'meta' => ['label' => 'Mission']],
            ['icon' => 'hgi-flag-01', 'title' => 'Réhabiliter, forer, diversifier', 'description' => 'Réhabiliter nos équipements pour terminer le forage de NAN-201, forer NAN-301 et NAN-302, réaliser les work-overs de ZNG-1D, ZNG-4D et ZNG-3D en 2026 ; puis fournir des services de Mud Logging, CTR, pompage et filtration, et forer jusqu\'à 6 puits de développement ou 4 puits d\'exploration en 2027.', 'meta' => ['label' => 'Objectifs 2026-2027']],
        ]);

        $this->seedGroup('about_values', [
            ['icon' => 'hgi-vest', 'title' => 'Sécurité avant tout', 'description' => 'Une culture HSE exigeante et un objectif constant de zéro incident sur chaque site.'],
            ['icon' => 'hgi-target-01', 'title' => 'Excellence opérationnelle', 'description' => 'Des standards élevés et une amélioration continue dans chaque phase de nos opérations.'],
            ['icon' => 'hgi-agreement-01', 'title' => 'Fiabilité & transparence', 'description' => 'Un partenaire de confiance pour des projets pétroliers complexes et exigeants.'],
            ['icon' => 'hgi-user-group', 'title' => 'Expertise congolaise', 'description' => 'Des équipes locales formées aux meilleurs standards internationaux du forage.'],
            ['icon' => 'hgi-leaf-01', 'title' => "Respect de l'environnement", 'description' => 'Une maîtrise des risques industriels conforme aux normes internationales.'],
            ['icon' => 'hgi-factory-01', 'title' => 'Filiale du groupe SNPC', 'description' => 'L\'appui et la solidité d\'un groupe national de référence dans le secteur pétrolier.'],
        ]);

        // Distinct from about_values: same theme, but home/about.blade.php's 2-card teaser uses
        // its own shorter wording and a different pair than the about page's full 6-value list.
        $this->seedGroup('home_ent_values', [
            ['icon' => 'hgi-target-01', 'title' => 'Excellence opérationnelle', 'description' => 'Des standards élevés, une amélioration continue et une exigence de résultat sur le terrain.'],
            ['icon' => 'hgi-agreement-01', 'title' => 'Fiabilité & transparence', 'description' => 'Un partenaire de confiance pour des projets pétroliers complexes et exigeants.'],
        ]);

        $this->seedGroup('equipements_perks', [
            ['icon' => 'hgi-warehouse', 'title' => 'Stockage', 'description' => 'Aire logistique pour le matériel de forage et les équipements techniques.'],
            ['icon' => 'hgi-settings-01', 'title' => 'Maintenance', 'description' => 'Entretien préventif et remise en état des rigs entre deux campagnes.'],
            ['icon' => 'hgi-delivery-truck-01', 'title' => 'Mobilisation', 'description' => 'Préparation et levage du matériel avant déploiement sur site.'],
        ]);

        $this->seedGroup('equipment_specs', [
            ['icon' => null, 'title' => 'MR-8000', 'description' => 'Rig MR-8000 Drillmec · 1080 HP', 'meta' => ['tag' => 'Rig principal', 'sub' => 'Drillmec', 'figure' => '1080', 'unite' => 'HP', 'constructeur' => 'Drillmec', 'type' => 'Rig de forage']],
            ['icon' => null, 'title' => 'MR-3500', 'description' => 'Unité mobile MR-3500', 'meta' => ['tag' => 'Second rig', 'sub' => 'Unité mobile']],
            ['icon' => null, 'title' => 'Base de Djeno', 'description' => 'Réception · Stockage · Entretien', 'meta' => ['tag' => 'Base · Djeno', 'figure' => '30 000', 'unite' => 'm²']],
        ]);
    }

    /**
     * @param  list<array{icon: ?string, title: string, description: string, meta?: array<string, string>}>  $items
     */
    private function seedGroup(string $group, array $items): void
    {
        foreach ($items as $position => $item) {
            // Matched by position (a fixed logical slot within the group), not title: a title
            // edited between seeder revisions must update that slot, not create a duplicate.
            ContentBlock::query()->updateOrCreate(
                ['group' => $group, 'position' => $position + 1],
                [
                    'icon' => $item['icon'] ?? null,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'meta' => $item['meta'] ?? null,
                ],
            );
        }
    }
}
