<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Project;
use App\Models\ContentCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        // Membuat Category
        ContentCategory::create([
            'name' => 'Line Distribution',
            'slug' => 'line-distribution',
            'icon_class' => 'las la-chart-pie'
        ]);

        ContentCategory::create([
            'name' => 'Line Evolution',
            'slug' => 'line-evolution',
            'icon_class' => 'las la-chart-bar'
        ]);

        ContentCategory::create([
            'name' => 'Album Distribution',
            'slug' => 'album-distribution',
            'icon_class' => 'las la-compact-disc'
        ]);

        ContentCategory::create([
            'name' => 'All Title Tracks Distribution',
            'slug' => 'all-title-tracks-distribution',
            'icon_class' => 'las la-music'
        ]);

        ContentCategory::create([
            'name' => 'All Songs Distribution',
            'slug' => 'all-songs-distribution',
            'icon_class' => 'las la-file-audio'
        ]);

        // Seeder Manual //

        User::create([
            'name' => 'Bagus Perdana',
            'username' => 'bagusper',
            'email' => 'baguspyus@gmail.com',
            'password' => bcrypt('password')
        ]);

        Artist::create([
            'artist_name' => 'OH MY GIRL',
            'codename' => 'oh-my-girl',
            'artist_birthday' => date('2015-04-21'),
            'artist_birthplace' => 'Seoul',
            'artist_pict' => 'ohmygirl.jpg',
            'fandom_name' => 'Miracle',
            'company_name' => 'WM Entertainment',
            'about' => 'OH MY GIRL is a South Korean group of eight members, consisting of Hyojung, JinE, Mimi, YooA, Seunghee, Jiho, Yubin (Binnie), and Arin. Unfortunately, JinE left the group in October 2017, followed by Jiho leaving the group on May 9, 2022. So that the members now consist of 6 members.',
        ]);

        Project::create([
            'project_title' => 'OH MY GIRL - Jine',
            'content_category_id' => 2,
            'project_requester' => 'Unknown Google Form Requester',
            'project_status' => 'Completed',
            'artist_id' => 1,
            'url' => 'https://www.youtube.com/embed/L-Hh_aQq6CE',
            'project_date' => date('2023-06-02'),
            'project_thumbnail' => 'https://i3.ytimg.com/vi/L-Hh_aQq6CE/maxresdefault.jpg',
            'project_class' => 'Huge Project Vol.#01',
            'progress' => 100,
            'votes' => 3,
        ]);

        Album::factory(50)->create();
        Artist::factory(50)->create();
        Project::factory(50)->create();
        Song::factory(50)->create();
    }
}
