<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Seeder;

class MilestonesSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the timeline currently hardcoded in the "Frise" section
     * of resources/views/about/index.blade.php.
     */
    public function run(): void
    {
        $entries = [
            ['year_label' => '2010', 'category' => 'Création', 'title' => 'Naissance de la SFP', 'description' => "La Société de Forages Pétroliers est créée comme filiale à 100 % du groupe SNPC, avec l'ambition de bâtir une expertise congolaise du forage pétrolier."],
            ['year_label' => '2011', 'category' => 'Premières opérations', 'title' => 'Démarrage sur le marché MKB', 'description' => 'La SFP démarre ses opérations en septembre 2011 sur le premier marché Mengo-Kudji-Bindi (MKB) attribué à la SNPC.'],
            ['year_label' => 'Depuis', 'category' => 'Croissance', 'title' => 'Une expertise reconnue', 'description' => 'Plusieurs puits onshore ont été forés sans incident pour les acteurs majeurs du secteur pétrolier congolais, consolidant la réputation de fiabilité de la SFP.'],
            ['year_label' => "Aujourd'hui", 'category' => "Aujourd'hui", 'title' => 'Excellence & sécurité au quotidien', 'description' => 'La SFP poursuit ses opérations avec une culture HSE exigeante et continue d\'investir dans la formation et la modernisation de ses équipements.'],
            ['year_label' => '2026', 'category' => 'Objectif', 'title' => 'Réhabilitation & nouveaux forages', 'description' => 'Réhabiliter nos équipements afin de terminer le forage de NAN-201, forer NAN-301 et NAN-302, et réaliser les work-overs de ZNG-1D, ZNG-4D et ZNG-3D.'],
            ['year_label' => '2027', 'category' => 'Objectif', 'title' => 'Diversification des services', 'description' => "Fournir divers services (Mud Logging, CTR, pompage, filtration) puis forer jusqu'à 6 puits de développement ou 4 puits d'exploration."],
        ];

        foreach ($entries as $position => $entry) {
            Milestone::query()->updateOrCreate(
                ['year_label' => $entry['year_label'], 'title' => $entry['title']],
                [...$entry, 'position' => $position + 1],
            );
        }
    }
}
