<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatBattle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'battle_id',
        'Average_Roll',
        'Average_Damage',
        'Highest_Damage',
        'Heal',
        'Damage_Taken',
        'kill',
        'Critical',
        'Miss',
        'Health_remaining'
    ];
}
