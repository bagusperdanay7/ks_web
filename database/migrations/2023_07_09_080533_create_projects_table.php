<?php

use App\Enums\Status;
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
            $table->string('title');
            $table->string('requester')->default("Unknown Google Forms Requester");
            $table->datetime('date')->nullable();
            $table->enum('status',  Status::toArray())->default(Status::PENDING->value);
            $table->string('youtube_id')->nullable();
            $table->integer('progress')->nullable()->default(0);
            $table->text('notes')->nullable();
            $table->integer('votes')->nullable()->default(0);
            $table->foreignId('category_id')->constrained(table: 'categories', indexName: 'projects_category_id');
            $table->foreignId('project_type_id')->constrained(table: 'project_types', indexName: 'projects_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_artist');
        Schema::dropIfExists('projects');
    }
};
