<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AIModel;
use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ! Activate this commented code if Database empty
        // User::factory(3)->create();

        // Membuat Category
        // ! Activate this commented code if Database empty
        // Category::create([
        //     'category_name' => 'Line Distribution',
        //     'slug' => 'line-distribution',
        //     'icon_class' => 'las la-chart-pie'],
        //     [
        //     'category_name' => 'Line Evolution',
        //     'slug' => 'line-evolution',
        //     'icon_class' => 'las la-chart-bar'],
        //     [
        //     'category_name' => 'Album Distribution',
        //     'slug' => 'album-distribution',
        //     'icon_class' => 'las la-compact-disc'],
        //     [
        //     'category_name' => 'Album Evolution',
        //     'slug' => 'all-evolution',
        //     'icon_class' => 'las la-file-audio'
        // ]);

        // ! Activate this commented code if Database empyty
        // ProjectType::create([
        //     "type_name" => "Non-Project",
        //     "slug" => "non-project",
        //     "about" => "Non-project Isn't based on your requests. Instead, it's based on our own desires and upcoming new comeback songs from particular artists.",
        // ],
        // [
        //     "type_name" => "Huge Project Vol.#01",
        //     "slug" => "huge-project-vol-1",
        //     "about" => "Huge Project Vol.#01 is a project based on Google Forms requests, where the content will be the line evolution of the female group of your choice.",
        // ],
        // [
        //     "type_name" => "Nostalgic Vibes",
        //     "slug" => "nostalgic-vibes",
        //     "about" => "Nostalgic Vibes is a project that is planned to be uploaded every weekend. Where the video contains the line distribution of old songs.",
        // ],
        // [
        //     "type_name" => "Youtube Comment",
        //     "slug" => "youtube-comment",
        //     "about" => "This project is retrieved from youtube comments.",
        // ]
        // );

        // ProjectType::create(
        // [
        //     "type_name" => "Huge Project Vol.#03",
        //     "slug" => "huge-project-vol-3",
        //     "about" => "Huge Project Vol.#03 is a project based on Google Forms requests, where the content will be the line evolution of the female group of your choice.",
        // ],
        // [
        //     "type_name" => "Memoriam Best Songs",
        //     "slug" => "memoriam-best",
        //     "about" => "Nostalgic Vibes is a project that is planned to be uploaded every weekend. Where the video contains the line distribution of old songs.",
        // ]);

        // Seeder Manual //

        // ! Activate this commented code if Database empyty
        // User::create([
        //     'name' => 'Bagus Perdana',
        //     'username' => 'bagusper',
        //     'email' => 'baguspyus@gmail.com',
        //     'password' => bcrypt('password')
        // ]);

        // ! Activate this commented code if Database empyty
        // Artist::create([
        //     'artist_name' => 'OH MY GIRL',
        //     'codename' => 'oh-my-girl',
        //     'debut' => date('2015-04-21'),
        //     'origin' => 'Seoul',
        //     'artist_pict' => 'ohmygirl.jpg',
        //     'fandom' => 'Miracle',
        //     'company' => 'WM Entertainment',
        //     'about' => 'OH MY GIRL is a South Korean group of eight members, consisting of Hyojung, JinE, Mimi, YooA, Seunghee, Jiho, Yubin (Binnie), and Arin. Unfortunately, JinE left the group in October 2017, followed by Jiho leaving the group on May 9, 2022. So that the members now consist of 6 members.',
        // ]);

        // ! Activate this commented code if Database empyty
        // Album::create([
        //     'artist_id' => 1,
        //     'album_name' => 'Fall In Love',
        //     'release' => date('2019-07-01'),
        // ]);

        // ! Activate this commented code if Database empyty
        // Song::create([
        //     'title' => 'Bungee',
        //     'genre' => 'Dance Pop',
        //     'author' => '서지음, 미미(오마이걸)',
        //     'composer' => 'Hyuk Shin @ 153/Joombas, 정윤 @ 153/Joombas, Ashley
        //     Alisha(153/Joombas), JJ Evans(153/Joombas), MooF(153/Joombas)',
        //     'arranger' => '정윤 @ 153/Joombas, MooF(153/Joombas)',
        // ]);

        // ! Activate this commented code if Database empyty
        // Project::create([
        //     'project_title' => 'OH MY GIRL - Jine',
        //     'artist_id' => 1,
        //     'category_id' => 2,
        //     'type_id' => 2,
        //     'date' => date('2023-06-02'),
        //     'requester' => 'Unknown Google Form Requester',
        //     'status' => 'Completed',
        //     'url' => 'https://www.youtube.com/embed/L-Hh_aQq6CE',
        //     'thumbnail' => 'https://i3.ytimg.com/vi/L-Hh_aQq6CE/maxresdefault.jpg',
        //     'progress' => 100,
        //     'votes' => 3,
        // ]);

        Artist::factory(10)->create();
        Album::factory(10)->create();
        Song::factory(10)->create();
        Project::factory(10)->create();
        AIModel::factory(10)->create();
    }
}
