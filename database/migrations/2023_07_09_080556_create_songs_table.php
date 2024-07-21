<?php

use App\Enums\SongCategory;
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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('duration')->nullable();
            $table->integer('track_number')->default(1);
            $table->enum('category',  SongCategory::toArray())->default(SongCategory::TRACK->value);
            $table->text('lyrics')->nullable();
            $table->foreignId('album_id')->constrained(table: 'albums', indexName: 'songs_album_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_artist');
        Schema::dropIfExists('songs');
    }
};
