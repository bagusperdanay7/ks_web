<?php

namespace Database\Seeders;


use App\Models\Idol;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Idol::create([
            'stage_name' => 'Yooa',
            'birth_name' => 'Yoo Si Ah',
            'artist_id' => 1
        ]);

        Idol::create([
            'stage_name' => 'Sunny',
            'birth_name' => 'Lee Sun Kyu',
            'artist_id' => 2
        ]);
    }
}
