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
            'content_category_id' => mt_rand(1, 5),
            'project_requester' => $this->faker->name(),
            'project_status' => implode($this->faker->randomElements(['Completed', 'On Process', 'Pending', 'Rejected'])),
            'url' => $this->faker->url(),
            'project_date' => $this->faker->dateTime(),
            'artist_id' => mt_rand(1, 20),
            'project_class' => implode($this->faker->randomElements(['Huge Project Vol.#01', 'Nostalgic Vibes', 'Youtube Comments', 'Non-Project'])),
            'progress' => $this->faker->numberBetween(0, 100),
            'votes' => $this->faker->numberBetween(1, 10),
            'notes' => $this->faker->sentence(),
        ];
    }
}
