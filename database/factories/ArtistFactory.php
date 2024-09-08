<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
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
            'artist_name' => fake()->name(),
            'codename' => Str::slug(fake()->unique()->userName()),
            'classification' => fake()->randomElement(['Group', 'Singer', 'Musician']),
            'birthdate' => fake()->date(),
            'origin' => fake()->city(),
            'fandom' => fake()->catchPhrase(),
            'about' => fake()->paragraph(),
            'company_id' => Company::factory()
        ];
    }
}
