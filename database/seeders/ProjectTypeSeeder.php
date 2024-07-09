<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ! Activate this commented code if Database empyty
        ProjectType::insert([
            [
                "type_name" => "Non-Project",
                "slug" => "non-project",
                "about" => "Non-project Isn't based on your requests. Instead, it's based on our own desires and upcoming new comeback songs from particular artists.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "type_name" => "Huge Project Vol.#01",
                "slug" => "huge-project-vol-1",
                "about" => "Huge Project Vol.#01 is a project based on Google Forms requests, where the content will be the line evolution of the female group of your choice.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "type_name" => "Nostalgic Vibes",
                "slug" => "nostalgic-vibes",
                "about" => "Nostalgic Vibes is a project that is planned to be uploaded every weekend. Where the video contains the line distribution of old songs.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "type_name" => "Youtube Comment",
                "slug" => "youtube-comment",
                "about" => "This project is retrieved from youtube comments.",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
