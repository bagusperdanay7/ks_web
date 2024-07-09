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
        Schema::create('playlist_project', function (Blueprint $table) {
            $table->integer('order');
            $table->boolean('main_video');
            $table->timestamps();
            $table->foreignId('playlist_id')->constrained('playlists', indexName: 'pp_playlist_id');
            $table->foreignId('project_id')->constrained('projects', indexName: 'pp_project_id');
            $table->primary(['playlist_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_project');
    }
};
