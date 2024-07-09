<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ! Activate this commented code if Database empyty
        Album::create([
            'name' => 'Fall In Love',
            'type' => 'Album',
            'release' => date('2019-07-01'),
            'publisher' => 4
        ]);

        Album::create([
            'name' => 'Oh!',
            'type' => 'Album',
            'release' => date('2010-07-01'),
            'publisher' => 1
        ]);
    }
}
