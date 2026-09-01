<?php

namespace Database\Factories;

use App\Models\Realisation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Realisation>
 */
class RealisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1, 100000),
            'category' => $this->faker->randomElement(['Forage', 'Complétion', 'Work Over']),
            'description' => $this->faker->paragraph(),
            'image' => null,
            'facts' => [['icon' => 'hgi-location-01', 'text' => $this->faker->city()]],
            'tags' => [$this->faker->word()],
            'position' => 0,
            'published_at' => now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(['published_at' => null]);
    }
}
