<?php

namespace Database\Factories;

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
            'title' => $this->faker->word(),
            'album_id' => mt_rand(1, 20),
            'genre' => implode($this->faker->randomElements(['Pop', 'Retro', 'EDM', 'Rock', 'Jazz', 'Dance', 'R&B'])),
            'category' => implode($this->faker->randomElements(['Title Track', 'Track'])),
            'author' => $this->faker->name(),
            'composer' => $this->faker->name(),
            'arranger' => $this->faker->name(),
        ];
    }
}
