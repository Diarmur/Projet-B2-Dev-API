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
        Schema::create('character_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('character_name', 50);
            $table->string('user_id');
            $table->string('race', 20);
            $table->string('class', 20);
            $table->unsignedInteger('level');
            $table->string('background', 50);
            $table->string('alignment', 20);
            $table->unsignedInteger('experience');
            $table->unsignedInteger('strength');
            $table->unsignedInteger('dexterity');
            $table->unsignedInteger('constitution');
            $table->unsignedInteger('intelligence');
            $table->unsignedInteger('wisdom');
            $table->unsignedInteger('charisma');
            $table->unsignedInteger('hit_points');
            $table->unsignedInteger('armor_class');
            $table->unsignedInteger('speed');
            $table->string('spell_book');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_sheets');
    }
};
