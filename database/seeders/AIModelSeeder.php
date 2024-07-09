<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\AIModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AIModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AIModel::factory(10)->recycle([Artist::all()])->create();
    }
}
