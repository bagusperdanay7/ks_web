<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('song_genres', function (Blueprint $table) {
            $table->foreignId('song_id')->constrained('songs', indexName: 'sg_song_id');
            $table->foreignId('genre_id')->constrained('genres', indexName: 'sg_genre_id');
            $table->primary(['song_id', 'genre_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_genres');
    }
};
