<?php

namespace Database\Factories;

use App\Models\Milestone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Milestone>
 */
class MilestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year_label' => (string) $this->faker->year(),
            'category' => $this->faker->randomElement(['Création', 'Croissance', 'Objectif']),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(15),
            'position' => 0,
        ];
    }
}
