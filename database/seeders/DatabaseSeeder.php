<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\AIModel;
use App\Models\Company;
use App\Models\Project;
use App\Models\Category;
use App\Models\Playlist;
use App\Models\ProjectType;
use App\Models\Idol;
use App\Models\PlaylistVideo;
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
        $exampleNumber = 50;

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
            PlaylistSeeder::class,
            IdolSeeder::class
        ]);

        // TODO: pindahkan ke seeder
        Artist::factory($exampleNumber)->recycle([
            Company::all()
        ])->create();

        Album::factory($exampleNumber)->recycle([
            Company::all()
        ])->create();

        Song::factory($exampleNumber)->recycle([
            Album::all()
        ])->create();

        // Idol
        Artist::factory($exampleNumber)->recycle([
            Company::all()
        ])->has(
            Idol::factory()
        )->create();

        // Playlist Project & Project
        Playlist::factory($exampleNumber)
            ->hasAttached(
                Project::factory($exampleNumber)->recycle([
                    Category::all(),
                    ProjectType::all()
                ])->create(),
                ['main_video' => false, 'order' => 1]
            )
            ->create();

        // Album Artist
        Artist::factory()
            ->has(Album::factory()->count($exampleNumber))
            ->create();

        // Song Genre
        Song::factory()
            ->has(Genre::factory($exampleNumber))
            ->create();

        // Song Artist
        Artist::factory()->recycle([
            Company::all()
        ])->hasAttached(
            Song::factory(3),
            ['role' => 'Primary Artist'],
        )->create();

        // Project Artist
        $artist = Artist::find(1);
        $artist->projects()->attach(1);
        Artist::factory()
            ->hasAttached(
                Project::factory($exampleNumber)->recycle([
                    Category::all(),
                    ProjectType::all()
                ]),
            )
            ->create();

        // Member Group
        Artist::factory()
            ->hasAttached(
                Idol::factory($exampleNumber),
                ['status' => 'Active'],
                'members'
            )->create();
    }
}
