<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bagus Perdana',
            'username' => 'bagus.py',
            'email' => 'baguspyus@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'credit' => 100,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::factory(5)->create();
    }
}
