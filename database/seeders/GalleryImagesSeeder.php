<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shots = [
            ['image' => 'rig-tall', 'title' => 'Appareil de forage SFP en opération', 'caption' => 'Appareil de forage'],
            ['image' => 'crew-platform', 'title' => 'Équipes SFP sur le plancher de forage', 'caption' => 'Équipes sur le terrain'],
            ['image' => 'rig-flag', 'title' => 'Mât de forage et drapeau du Congo', 'caption' => 'Mât de forage'],
            ['image' => 'leadership', 'title' => 'Responsables et équipes SFP réunis sur site', 'caption' => 'Direction & équipes'],
            ['image' => 'crew-women', 'title' => 'Techniciens SFP en relève de poste', 'caption' => 'Sur le site'],
            ['image' => 'rig03-unit', 'title' => 'Contrôle de la tête de puits', 'caption' => 'Suivi des opérations'],
            ['image' => 'mobilization', 'title' => "Mobilisation d'un appareil de forage à la grue", 'caption' => 'Mobilisation'],
            ['image' => 'crew-walking', 'title' => 'Collaborateurs SFP en tenue de sécurité', 'caption' => 'Culture sécurité'],
            ['image' => 'crew-mudpumps', 'title' => 'Suivi des opérations de forage', 'caption' => 'Suivi des opérations'],
        ];

        foreach ($shots as $position => $shot) {
            GalleryImage::query()->updateOrCreate(
                ['image' => $shot['image']],
                [...$shot, 'position' => $position],
            );
        }
    }
}
