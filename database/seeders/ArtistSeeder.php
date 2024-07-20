<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ! Activate this commented code if Database empyty
        Artist::create([
            "artist_name" => "OH MY GIRL",
            "codename" => "oh-my-girl",
            "classification" => "Group",
            "birthdate" => date("2015-04-21"),
            "origin" => "Seoul, South Korea",
            "artist_picture" => "hero_img1.jpg",
            "fandom" => "Miracle",
            "about" => "OH MY GIRL (Korean: 오마이걸, Japanese: オーマイガール) is a South Korean girl group, that debuted on April 20, 2015, with a mini album entitled 'OH MY GIRL'. OH MY GIRL originally consisted of eight members, namely Hyojung (효정), JinE (진이), Mimi (미미), YooA (유아), Seunghee (승희), Jiho (지호), Yubin (유빈), and Arin (아린). Sadly, JinE left the group in October 2017, followed by Jiho who left the group on May 9, 2022. So the members now consist of 6 members. The last album was 'Golden Hourglass' released on July 24, 2023.",
            "company_id" => 4,
        ]);

        Artist::create([
            "artist_name" => "Girls' Generation",
            "codename" => "girls-generation",
            "classification" => "Group",
            "birthdate" => date("2007-08-05"),
            "origin" => "Seoul, South Korea",
            "fandom" => "Sone",
            "about" => "Girls' Generation (Korean: 소녀시대, Japanese: 少女時代) also known as SNSD is a South Korean girl group, that debuted on August 5, 2007, with the single 'Into the New World'. Girls' Generation originally consisted of nine members, namely Taeyeon (태연), Jessica (제시카), Sunny (써니), Tiffany (티파니), Hyoyeon (효연), Yuri (유리), Sooyoung (수영), Yoona (윤아), and Seohyun (서현). Unfortunately, Jessica left the group on September 30, 2014. So the members now consist of 8 members.",
            "company_id" => 1,
        ]);
    }
}
