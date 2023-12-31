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
            $table->string('cover_model', 100)->nullable();
            $table->string('url')->nullable();
            $table->string('status', 10)->nullable()->default('Pending');
            $table->text('description')->nullable();
            $table->string('sample', 100)->nullable(); #atau jadi url dan upload ke soundcloud
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
