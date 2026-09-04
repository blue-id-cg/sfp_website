<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the text content currently hardcoded in
     * resources/views/home.blade.php + home/*.blade.php, about/index.blade.php,
     * metiers/index.blade.php, hse/index.blade.php and equipements/index.blade.php,
     * matching the schema in config('pages.schemas').
     */
    public function run(): void
    {
        $this->seedPage('home', [
            'hero' => [
                'subhead' => "Société de Forages Pétroliers · l'expertise congolaise du forage, de la complétion et du work over. Des opérations maîtrisées, sûres et performantes, au cœur du bassin pétrolier.",
                'cta_primary_label' => 'Découvrir nos métiers',
                'cta_secondary_label' => 'Nous contacter',
            ],
            'about' => [
                'kicker' => "L'entreprise",
                'title' => "Une expertise congolaise au cœur de l'industrie pétrolière",
                'lead' => 'Depuis 2010, la SFP conçoit et opère des forages onshore pour les acteurs majeurs du secteur pétrolier congolais — avec un principe non négociable : zéro incident.',
                'mission' => 'Notre mission : fournir des prestations de haute qualité tout au long du cycle de vie des puits, en garantissant la sécurité de nos équipes, la maîtrise des risques industriels et le respect des normes internationales.',
            ],
            'activities' => [
                'kicker' => 'Nos métiers',
                'title' => 'Le cycle de vie du puits, maîtrisé de bout en bout',
                'lead' => 'De la préparation des opérations à la maintenance des installations, nos équipes couvrent l\'ensemble des disciplines du forage pétrolier.',
            ],
            'technology' => [
                'kicker' => 'Innovation',
                'title' => 'Performance opérationnelle & digitalisation',
                'lead' => "Nous intégrons les technologies les plus avancées pour optimiser chaque phase de nos opérations : de la surveillance en temps réel à l'analyse des données, jusqu'à la modernisation des équipements.",
            ],
            'equipment' => [
                'kicker' => 'Équipements',
                'title' => 'Un parc industriel à la hauteur des enjeux',
                'lead' => "Deux rigs, le MR-8000 Drillmec (1080 HP) et le MR-3500, ainsi qu'une base opérationnelle de 30 000 m² à Djeno pour la réception, le stockage et l'entretien des équipements.",
            ],
            'hse' => [
                'kicker' => 'Santé · Sécurité · Environnement',
                'title' => 'La sécurité avant la performance',
                'lead' => "Notre engagement pour la santé, la sécurité et l'environnement est non négociable : le fondement de notre culture d'entreprise.",
            ],
            'realisations' => [
                'kicker' => 'Nos réalisations',
                'title' => 'Des opérations menées avec exigence',
                'lead' => "Un aperçu des opérations à l'actif de la SFP depuis le démarrage de ses activités en 2011.",
            ],
            'careers' => [
                'kicker' => 'Carrières',
                'title' => "Des métiers d'exigence, une équipe qui progresse",
                'lead' => 'Formation continue, transmission du savoir-faire et culture de sécurité : découvrez pourquoi rejoindre la SFP, et nos postes actuellement ouverts.',
            ],
            'gallery' => [
                'kicker' => 'Galerie',
                'title' => 'Le forage, en images',
                'lead' => 'Plateformes, équipements, équipes sur le terrain : des images qui racontent le quotidien et le savoir-faire de la SFP.',
            ],
            'actualites_teaser' => [
                'kicker' => 'Actualités',
                'title' => 'Les temps forts de la SFP',
                'lead' => "Un aperçu de nos dernières publications. Retrouvez l'ensemble de nos actualités sur la page dédiée.",
            ],
            'contact' => [
                'kicker' => 'Contact',
                'title' => 'Discutons de vos projets',
                'lead' => 'Une question, un projet, un partenariat ? Nos équipes sont à votre écoute pour vous accompagner à chaque étape.',
            ],
        ]);

        $this->seedPage('about', [
            'intro' => [
                'kicker' => "L'entreprise",
                'title' => 'À propos de la SFP',
                'lead' => "L'expertise congolaise du forage pétrolier, au service des grands opérateurs du secteur.",
            ],
            'histoire' => [
                'kicker' => 'Notre histoire',
                'title' => 'Une expertise congolaise née sur le terrain',
                'paragraphs' => implode("\n\n", [
                    'La Société de Forages Pétroliers (SFP) est créée en 2010, filiale à 100 % du groupe SNPC (Société Nationale des Pétroles du Congo), avec une ambition claire : bâtir une expertise nationale capable de rivaliser avec les meilleurs prestataires internationaux du forage pétrolier.',
                    "L'entreprise démarre ses opérations en septembre 2011, sur le premier marché MKB (Mengo-Kundji-Bindi) attribué à la SNPC. Cette première campagne pose les bases de la méthode SFP : rigueur technique, discipline opérationnelle et culture de sécurité affirmée dès les premiers puits forés.",
                    "Depuis, la SFP a élargi son champ d'intervention au forage, à la complétion et au work over, en assurant plusieurs puits onshore forés sans incident pour les acteurs majeurs du secteur pétrolier congolais. Cette continuité opérationnelle, sans accroc, est aujourd'hui la meilleure garantie que l'entreprise peut offrir à ses partenaires.",
                    "Ce socle repose sur des équipes congolaises formées aux meilleurs standards internationaux, qui opèrent des appareils de forage modernes dans le respect strict des normes de sécurité et d'environnement en vigueur dans l'industrie pétrolière.",
                ]),
            ],
            'expertise' => [
                'kicker' => 'Savoir-faire',
                'title' => 'Nos domaines d\'expertise',
                'lead' => 'Du forage à la diversification des services techniques, une chaîne de compétences maîtrisée de bout en bout.',
            ],
            'pillars' => [
                'kicker' => 'Cap stratégique',
                'title' => 'Vision, mission & objectifs',
            ],
            'timeline' => [
                'kicker' => 'Parcours',
                'title' => 'Les grandes étapes de la SFP',
            ],
            'values' => [
                'kicker' => 'Nos valeurs',
                'title' => 'Ce qui guide chacune de nos opérations',
            ],
            'cta' => [
                'kicker' => 'Rejoignez-nous',
                'title' => 'Envie de participer à nos opérations ?',
                'lead' => 'Découvrez nos offres d\'emploi et rejoignez une équipe d\'excellence au service de l\'énergie congolaise.',
                'button_label' => "Voir les offres d'emploi",
            ],
        ]);

        $this->seedPage('metiers', [
            'intro' => [
                'kicker' => 'Nos métiers',
                'title' => 'Le cycle de vie du puits, maîtrisé de bout en bout',
                'lead' => "De la préparation des opérations à la maintenance des installations, nos équipes couvrent l'ensemble des disciplines du forage pétrolier avec des équipements spécialisés.",
            ],
            'innovation' => [
                'kicker' => 'Innovation',
                'title' => 'Performance opérationnelle & digitalisation',
                'lead' => "Nous intégrons les technologies les plus avancées pour optimiser chaque phase de nos opérations : de la surveillance en temps réel à l'analyse des données, jusqu'à la modernisation des équipements.",
            ],
            'cta' => [
                'kicker' => 'Rejoignez-nous',
                'title' => 'Envie de mettre votre expertise au service du forage ?',
                'lead' => "Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.",
                'button_label' => "Voir les offres d'emploi",
            ],
        ]);

        $this->seedPage('hse', [
            'intro' => [
                'kicker' => 'Santé · Sécurité · Environnement',
                'title' => 'La sécurité avant la performance',
                'lead' => "Notre engagement pour la santé, la sécurité et l'environnement est non négociable. C'est le fondement de notre culture d'entreprise et la condition de chaque opération.",
            ],
            'engagements' => [
                'kicker' => 'Nos engagements',
                'title' => 'Une culture HSE au quotidien',
            ],
            'method' => [
                'kicker' => 'Notre méthode',
                'title' => 'Une démarche structurée, du bureau au terrain',
                'lead' => "La prévention se construit avant l'arrivée sur site : analyse des risques, plans d'action et procédures validées en amont, puis appliquées avec rigueur sur chaque chantier.",
            ],
        ]);

        $this->seedPage('equipements', [
            'intro' => [
                'kicker' => 'Équipements',
                'title' => 'Un parc industriel à la hauteur des enjeux',
                'lead' => "Deux rigs, le MR-8000 Drillmec (1080 HP) et le MR-3500, ainsi qu'une base opérationnelle de 30 000 m² à Djeno pour la réception, le stockage et l'entretien des équipements avant leur déploiement sur site.",
            ],
            'base' => [
                'kicker' => 'Base de Djeno',
                'title' => '30 000 m² dédiés à la préparation des opérations',
                'lead' => 'Réception, stockage, entretien et remise en état des équipements avant chaque mobilisation sur site.',
            ],
            'cta' => [
                'kicker' => 'Rejoignez-nous',
                'title' => 'Envie de travailler sur nos appareils de forage ?',
                'lead' => "Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.",
                'button_label' => "Voir les offres d'emploi",
            ],
        ]);
    }

    /**
     * @param  array<string, array<string, string>>  $content
     */
    private function seedPage(string $slug, array $content): void
    {
        Page::query()->updateOrCreate(['slug' => $slug], ['content' => $content]);
    }
}
