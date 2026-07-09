<?php

namespace Database\Factories;

use App\Models\Actualite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Actualite>
 */
class ActualiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1, 100000),
            'category' => $this->faker->randomElement(['Opérations', 'HSE', 'Innovation']),
            'excerpt' => $this->faker->sentence(20),
            'body' => implode("\n\n", $this->faker->paragraphs(3)),
            'image' => null,
            'published_at' => now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(['published_at' => null]);
    }
}
