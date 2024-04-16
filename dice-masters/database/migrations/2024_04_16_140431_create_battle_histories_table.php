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
        Schema::create('battle_histories', function (Blueprint $table) {
            $table->string('battle_id');
            $table->string('user_id');
            $table->timestamps();
            $table->primary(['battle_id', 'user_id']);
            $table->foreign('battle_id')->references('id')->on('battles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_histories');
    }
};
