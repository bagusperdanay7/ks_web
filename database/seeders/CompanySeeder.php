<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Company::insert([
            ["name" => "SM Entertainment", "created_at" => now(), "updated_at" => now()],
            ["name" => "JYP Entertainement", "created_at" => now(), "updated_at" => now()],
            ["name" => "YG Entertainment", "created_at" => now(), "updated_at" => now()],
            ["name" => "WM Entertainment", "created_at" => now(), "updated_at" => now()]
        ]);

        Company::factory(6)->create();
    }
}
