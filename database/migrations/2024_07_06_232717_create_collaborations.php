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
        Schema::create('collaborations', function (Blueprint $table) {
            $table->enum('role', ['Primary Artist', 'Featured Artist']);
            $table->timestamps();
            $table->foreignId('song_id')->constrained('songs', indexName: 'collaborations_song_id');
            $table->foreignId('artist_id')->constrained('artists', indexName: 'collaborations_artist_id');
            $table->primary(['song_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
