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
            $table->foreignId('artist_id');
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->string('project_title');
            $table->string('requester')->default("Unknown Google Forms Requester");
            $table->date('date')->nullable();
            $table->string('status')->default('Pending');
            $table->string('url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('progress')->nullable()->default(0);
            $table->text('notes')->nullable();
            $table->integer('votes')->nullable()->default(0);
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
