<?php

use App\Enums\ArtistRole;
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
        Schema::create('song_artist', function (Blueprint $table) {
            $table->foreignId('song_id')->constrained('songs', indexName: 'collaborations_song_id');
            $table->foreignId('artist_id')->constrained('artists', indexName: 'collaborations_artist_id');
            $table->enum('role',  ArtistRole::toArray())->default(ArtistRole::PRIMARY->value);
            $table->timestamps();
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
