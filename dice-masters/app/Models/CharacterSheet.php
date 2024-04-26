<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_name',
        'user_id',
        'race',
        'class',
        'level',
        'background',
        'alignment',
        'experience',
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
        'hit_points',
        'armor_class',
        'speed',
        'spell_book'
    ];
}
