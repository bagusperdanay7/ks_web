<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // * Example Data
        // ! Activate this commented code if Database empty
        Category::insert(
            [
                [
                    'category_name' => 'Line Distribution',
                    'slug' => 'line-distribution',
                    'icon_class' => 'las la-chart-pie',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category_name' => 'Line Evolution',
                    'slug' => 'line-evolution',
                    'icon_class' => 'las la-chart-bar',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category_name' => 'Album Distribution',
                    'slug' => 'album-distribution',
                    'icon_class' => 'las la-compact-disc',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category_name' => 'Total Line Evolution',
                    'slug' => 'all-evolution',
                    'icon_class' => 'las la-file-audio',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
