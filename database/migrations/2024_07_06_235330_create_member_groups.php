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
        Schema::create('member_groups', function (Blueprint $table) {
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
            $table->foreignId('idol_id')->constrained(table: 'idols', indexName: 'member_groups_idol_id');
            $table->foreignId('artist_id')->constrained(table: 'artists', indexName: 'member_groups_artist_id');
            $table->primary(['idol_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_groups');
    }
};