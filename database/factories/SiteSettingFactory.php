<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_address' => $this->faker->address(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->companyEmail(),
            'founding_year' => 2011,
            'rigs_count' => 2,
            'incidents_count' => 0,
        ];
    }
}
