<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AIModel>
 */
class AIModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_name' => fake()->sentence(3),
            'url' => fake()->url(),
            'status' => fake()->randomElement(['Completed', 'In Progress', 'Pending', 'Rejected']),
            'description' => fake()->paragraph(2),
            'artist_id' => Artist::factory()
        ];
    }
}
