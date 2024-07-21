<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ! Activate this commented code if Database empyty
        // TODO: Move to writers
        // Song::create([
        //     'title' => 'Bungee',
        //     'genre' => 'Dance Pop',
        //     'author' => '서지음, 미미(오마이걸)',
        //     'composer' => 'Hyuk Shin @ 153/Joombas, 정윤 @ 153/Joombas, Ashley
        //     Alisha(153/Joombas), JJ Evans(153/Joombas), MooF(153/Joombas)',
        //     'arranger' => '정윤 @ 153/Joombas, MooF(153/Joombas)',
        // ]);
        Song::create([
            'title' => 'Bungee',
            'duration' => 185,
            'track_number' => 1,
            'category' => 'Title Track',
            'album_id' => 1
        ]);

        Song::create([
            'title' => 'Oh!',
            'duration' => 189,
            'track_number' => 1,
            'category' => 'Title Track',
            'album_id' => 1
        ]);
    }
}
