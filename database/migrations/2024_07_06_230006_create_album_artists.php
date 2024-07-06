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
        Schema::create('album_artists', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('album_id')->constrained('albums', indexName: 'aa_album_id');
            $table->foreignId('artist_id')->constrained('artists', indexName: 'aa_artist_id');
            $table->primary(['album_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_artists');
    }
};
