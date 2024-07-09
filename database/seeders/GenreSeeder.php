<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::insert([
            [
                'name' => 'K-Pop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dance',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Synthpop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ballad',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jazz',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
