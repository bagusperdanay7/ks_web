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
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->string('title');
            $table->string('requester')->default("Unknown Google Forms Requester");
            $table->datetime('date')->nullable();
            $table->enum('status', ['Completed', 'On Process', 'Pending', 'Rejected'])->default('Pending');
            $table->string('url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('progress')->nullable()->default(0);
            $table->text('notes')->nullable();
            $table->integer('votes')->nullable()->default(0);
            $table->boolean('exclusive')->default(false);
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
