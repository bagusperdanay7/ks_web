<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'duration' => fake()->randomNumber(3),
            'category' => fake()->randomElement(['Track', 'Title Track']),
            'lyrics' => fake()->realText(),
            'album_id' => Album::factory(),
        ];
    }
}
