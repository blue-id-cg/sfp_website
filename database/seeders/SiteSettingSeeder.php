<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds. Backfills the values currently hardcoded across
     * partials/footer.blade.php, home/contact.blade.php, home/hero.blade.php and about/index.blade.php.
     */
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate([], [
            'contact_address' => 'Avenue du Général de Gaulle, B.P. 622, Pointe-Noire, République du Congo',
            'contact_phone' => '+242 06 587 07 28',
            'contact_email' => 'contact@snpc-sfp.net',
            'founding_year' => 2011,
            'rigs_count' => 2,
            'incidents_count' => 0,
        ]);
    }
}
