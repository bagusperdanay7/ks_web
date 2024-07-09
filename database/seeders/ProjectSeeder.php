<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Embed Youtube = https://www.youtube.com/embed/L-Hh_aQq6CE
        // Thumbnail = https://i3.ytimg.com/vi/L-Hh_aQq6CE/maxresdefault.jpg
        // ! Activate this commented code if Database empyty
        Project::create([
            'title' => 'OH MY GIRL - Jine',
            'date' => date('2023-06-02'),
            'requester' => 'Unknown Google Form Requester',
            'status' => 'Completed',
            'youtube_id' => 'L-Hh_aQq6CE',
            'progress' => 100,
            'votes' => 3,
            'category_id' => 2,
            'project_type_id' => 2,
        ]);
    }
}
