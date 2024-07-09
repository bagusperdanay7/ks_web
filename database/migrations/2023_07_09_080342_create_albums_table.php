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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Single', 'EP', 'Album'])->default('EP');
            $table->date('release');
            $table->string('cover')->nullable();
            $table->foreignId('publisher')->constrained(table: 'companies', indexName: 'albums_publisher_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
