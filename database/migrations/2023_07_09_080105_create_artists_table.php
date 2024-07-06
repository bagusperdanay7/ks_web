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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('artist_name');
            $table->string('codename')->unique();
            $table->enum('classification', ['Group', 'Singer', 'Musician']);
            $table->date('birthdate')->nullable();
            $table->string('origin')->nullable();
            $table->string('artist_picture')->nullable();
            $table->string('fandom')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('company_id')->constrained(table: 'companies', indexName: 'artists_company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
