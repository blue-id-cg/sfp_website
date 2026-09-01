<?php

namespace Database\Seeders;

use App\Models\Realisation;
use Illuminate\Database\Seeder;

class RealisationsSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the two case studies currently hardcoded in
     * resources/views/home/realisations.blade.php.
     */
    public function run(): void
    {
        Realisation::query()->updateOrCreate(
            ['slug' => 'forage-de-puits-a-kundji'],
            [
                'title' => 'Forage de puits à Kundji',
                'image' => 'rig-stairs',
                'category' => 'Forage · Onshore',
                'description' => 'Réalisation de puits en environnement onshore, dans le respect des standards de sécurité et de qualité.',
                'facts' => [
                    ['icon' => 'fa-solid fa-location-dot', 'text' => 'Kundji'],
                    ['icon' => 'fa-solid fa-bullseye', 'text' => 'Forage onshore'],
                ],
                'tags' => [],
                'position' => 1,
                'published_at' => now(),
            ],
        );

        Realisation::query()->updateOrCreate(
            ['slug' => 'workovers-a-kundji-mbondji-zingali'],
            [
                'title' => 'Workovers à Kundji, Mbondji & Zingali',
                'image' => 'crew-mudpumps',
                'category' => 'Work Over',
                'description' => 'Interventions de work over pour restaurer et améliorer la performance de puits en production, complétées par nos services de mud logging et de CTR pendant les forages.',
                'facts' => [
                    ['icon' => 'fa-solid fa-location-dot', 'text' => 'Kundji · Mbondji · Zingali'],
                    ['icon' => 'fa-solid fa-layer-group', 'text' => '3 sites'],
                ],
                'tags' => ['Mud logging', 'CTR'],
                'position' => 2,
                'published_at' => now(),
            ],
        );
    }
}
