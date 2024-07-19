<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->lexify('?????? - ??????'),
            'requester' => fake()->name(),
            'date' => fake()->dateTime(),
            'status' => fake()->randomElement(['Completed', 'In Progress', 'Pending', 'Rejected']),
            'youtube_id' => fake()->md5(),
            'progress' => fake()->numberBetween(0, 100),
            'notes' => fake()->sentence(),
            'votes' => fake()->numberBetween(1, 10),
            'exclusive' => fake()->boolean(),
            'category_id' => mt_rand(1, 4),
            'project_type_id' => mt_rand(1, 4),
        ];
    }
}
