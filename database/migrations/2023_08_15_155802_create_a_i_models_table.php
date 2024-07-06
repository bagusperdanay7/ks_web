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
        Schema::create('a_i_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('url')->nullable();
            $table->enum('status', ['Completed', 'Pending', 'On Process', 'Rejected'])->nullable()->default('Pending');
            $table->text('description')->nullable();
            $table->string('audio_sample', 100)->nullable();
            $table->foreignId('artist_id')->constrained('artists', indexName: 'aimodels_artist_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_models');
    }
};
