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
        Schema::create('songwriters', function (Blueprint $table) {
            $table->enum('role', ['Lyricist', 'Composer', 'Arranger', 'Conductor', 'Producer']);
            $table->timestamps();
            $table->foreignId('song_id')->constrained('songs', indexName: 'songwriter_song_id');
            $table->foreignId('artist_id')->constrained('artists', indexName: 'songwriter_artist_id');
            $table->primary(['song_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songwriters');
    }
};
