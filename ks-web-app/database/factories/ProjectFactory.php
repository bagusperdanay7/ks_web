<?php

namespace Database\Factories;

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
            'project_title' => $this->faker->lexify('?????? - ??????'),
            'category_id' => mt_rand(1, 4),
            'artist_id' => mt_rand(1, 20),
            'type_id' => mt_rand(1, 4),
            'requester' => $this->faker->name(),
            'date' => $this->faker->dateTime(),
            'status' => implode($this->faker->randomElements(['Completed', 'On Process', 'Pending', 'Rejected'])),
            'url' => $this->faker->url(),
            'progress' => $this->faker->numberBetween(0, 100),
            'notes' => $this->faker->sentence(),
            'votes' => $this->faker->numberBetween(1, 10),
        ];
    }
}
