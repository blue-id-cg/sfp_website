<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Trade;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the equipment catalog, cross-referenced with the
     * trades (métiers) that use each item — the "equipment_specs" ContentBlock group on
     * home/equipment.blade.php only carries the same two rigs as flat spec figures, with
     * no room for a downloadable spec sheet or a link to the trades that use them.
     */
    public function run(): void
    {
        $equipment = [
            [
                'slug' => 'rig-mr-8000-drillmec',
                'title' => 'Rig MR-8000 Drillmec',
                'description' => 'Appareil de forage principal de la flotte SFP, mât de 1080 HP.',
                'body' => "<p>Le MR-8000 Drillmec est le rig principal de la SFP, capable de forer des puits profonds grâce à son mât de 1080 HP. Il est déployé pour les campagnes de forage et de complétion sur les sites d'opération.</p>",
                'image' => 'rig-sky',
                'position' => 1,
                'trades' => ['forage-petrolier', 'completion', 'casing-tubing'],
            ],
            [
                'slug' => 'unite-mobile-mr-3500',
                'title' => 'Unité mobile MR-3500',
                'description' => 'Second rig de la flotte SFP, pour les opérations de forage et de work over.',
                'body' => '<p>Le MR-3500 est une unité mobile qui complète la flotte de la SFP. Sa mobilité en fait un outil adapté aux interventions de work over et aux campagnes de forage de taille intermédiaire.</p>',
                'image' => 'rig03-unit',
                'position' => 2,
                'trades' => ['forage-petrolier', 'work-over'],
            ],
            [
                'slug' => 'pompes-a-boue',
                'title' => 'Pompes à boue',
                'description' => 'Circulation et pompage du fluide de forage sur le site.',
                'body' => '<p>Les pompes à boue assurent la circulation continue du fluide de forage dans le puits : refroidissement de l\'outil, remontée des déblais et maintien de la pression. Un équipement essentiel du métier pompage & filtration.</p>',
                'image' => 'crew-mudpumps',
                'position' => 3,
                'trades' => ['pompage-filtration', 'mud-logging'],
            ],
        ];

        foreach ($equipment as $item) {
            $tradeSlugs = $item['trades'];
            unset($item['trades']);

            $record = Equipment::query()->updateOrCreate(['slug' => $item['slug']], $item);
            $tradeIds = Trade::query()->whereIn('slug', $tradeSlugs)->pluck('id');
            $record->trades()->sync($tradeIds);
        }
    }
}
