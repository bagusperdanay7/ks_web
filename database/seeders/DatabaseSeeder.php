<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Artist;
use App\Models\AIModel;
use App\Models\Company;
use App\Models\Project;
use App\Models\Category;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\ProjectType;
use Illuminate\Database\Seeder;
use Database\Seeders\SongSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AlbumSeeder;
use Database\Seeders\ArtistSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProjectTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // * New
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            CategorySeeder::class,
            ProjectTypeSeeder::class,
            ArtistSeeder::class,
            AlbumSeeder::class,
            SongSeeder::class,
            ProjectSeeder::class,
            AIModelSeeder::class,
            GenreSeeder::class,
            PlaylistSeeder::class
        ]);

        // Coba pindahkan ke seeder
        Artist::factory(10)->recycle([
            Company::all()
        ])->create();

        Album::factory(10)->recycle([
            Company::all()
        ])->create();

        Song::factory(10)->recycle([
            Album::all()
        ])->create();

        // Playlist Project & Project

        Playlist::factory()
            ->hasAttached(
                Project::factory(10)->recycle([
                    Category::all(),
                    ProjectType::all()
                ])->create(),
                ['main_video' => false, 'order' => 1]
            )
            ->create();


        Artist::factory()
            ->has(Album::factory()->count(3))
            ->create();
    }
}
