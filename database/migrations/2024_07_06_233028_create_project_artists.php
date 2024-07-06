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
        Schema::create('project_artists', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('project_id')->constrained('projects', indexName: 'pa_project_id');
            $table->foreignId('artist_id')->constrained('artists', indexName: 'pa_artist_id');
            $table->primary(['project_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_artists');
    }
};
