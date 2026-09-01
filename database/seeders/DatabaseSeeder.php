<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            ActualitesSeeder::class,
            OffresSeeder::class,
            GalleryImagesSeeder::class,
            SiteSettingSeeder::class,
            ContentBlocksSeeder::class,
            RealisationsSeeder::class,
            MilestonesSeeder::class,
            PagesSeeder::class,
        ]);
    }
}
