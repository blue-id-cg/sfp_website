<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = $this->faker->uuid().'.jpg';

        return [
            'disk' => 'public',
            'path' => 'media/'.$filename,
            'original_name' => $filename,
            'mime_type' => 'image/jpeg',
            'size' => $this->faker->numberBetween(10_000, 2_000_000),
            'alt_text' => $this->faker->sentence(4),
        ];
    }
}
