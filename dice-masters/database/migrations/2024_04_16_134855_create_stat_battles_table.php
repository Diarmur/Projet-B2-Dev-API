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
        Schema::create('stat_battles', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('battle_id');
            $table->primary(['user_id', 'battle_id']);
            $table->integer('Average_Roll');
            $table->integer('Average_Damage');
            $table->integer('Highest_Damage');
            $table->integer('Heal');
            $table->integer('Damage_Taken');
            $table->integer('Kill');
            $table->integer('Critical');
            $table->integer('Miss');
            $table->integer('Healt_remaining');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('battle_id')->references('id')->on('battles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stat_battles');
    }
};
