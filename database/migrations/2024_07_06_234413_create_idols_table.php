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
        Schema::create('idols', function (Blueprint $table) {
            $table->id();
            $table->string('stage_name');
            $table->string('birth_name');
            $table->foreignId('artist_id')->constrained(table: 'artists', indexName: 'idols_artist_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idols');
    }
};
