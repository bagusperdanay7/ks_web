<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_id' => mt_rand(1, 20),
            'album_name' => $this->faker->word(),
            'release' => $this->faker->dateTime(),
            'publisher' => $this->faker->company()
        ];
    }
}
