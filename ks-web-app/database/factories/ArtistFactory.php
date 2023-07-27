<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_name' => $this->faker->name(),
            'codename' => $this->faker->unique()->name(),
            'artist_birthday' => $this->faker->dateTime(),
            'artist_birthplace' => $this->faker->city(),
            'fandom_name' => $this->faker->catchPhrase(),
            'company_name' => $this->faker->company(),
            'about' => $this->faker->paragraph(),
        ];
    }
}
