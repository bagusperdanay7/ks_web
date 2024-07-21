<?php

use App\Enums\MemberStatus;
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
        Schema::create('member_group', function (Blueprint $table) {
            $table->foreignId('idol_id')->constrained(table: 'idols', indexName: 'member_groups_idol_id');
            $table->foreignId('artist_id')->constrained(table: 'artists', indexName: 'member_groups_artist_id');
            $table->enum('status',  MemberStatus::toArray())->default(MemberStatus::ACTIVE->value);
            $table->timestamps();
            $table->primary(['idol_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_group');
        Schema::dropIfExists('member_groups');
    }
};
