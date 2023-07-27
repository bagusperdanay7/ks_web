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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_title');
            $table->foreignId('content_category_id');
            $table->string('project_requester');
            $table->string('project_status')->default('Pending');
            $table->text('url')->nullable();
            $table->date('project_date')->nullable();
            $table->string('project_thumbnail')->nullable();
            $table->foreignId('artist_id');
            $table->string('project_class')->default('Non-Project');
            $table->integer('progress')->nullable();
            $table->integer('votes')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
