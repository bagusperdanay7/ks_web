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
        Schema::create('album_song', function (Blueprint $table) {
            $table->id();
            $table->integer('track_number');
            // TODO: Add Category, Hapus Yang Di Songs table
            $table->foreignId('album_id');
            $table->foreignId('song_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_songs');
    }
};
