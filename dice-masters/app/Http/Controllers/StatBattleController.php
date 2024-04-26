<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatBattle;

class StatBattleController extends Controller
{
    public function index() {
        return StatBattle::all();
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'battle_id' => 'required|integer',
            'Average_Roll' => 'required|integer',
            'Average_Damage' => 'required|integer',
            'Highest_Damage' => 'required|integer',
            'Heal' => 'required|integer',
            'Damage_Taken' => 'required|integer',
            'kill' => 'required|integer',
            'Critical' => 'required|integer',
            'Miss' => 'required|integer',
            'Health_remaining' => 'required|integer'
        ]);

        $statBattle = new StatBattle();
        $statBattle->user_id = $request->user_id;
        $statBattle->battle_id = $request->battle_id;
        $statBattle->Average_Roll = $request->Average_Roll;
        $statBattle->Average_Damage = $request->Average_Damage;
        $statBattle->Highest_Damage = $request->Highest_Damage;
        $statBattle->Heal = $request->Heal;
        $statBattle->Damage_Taken = $request->Damage_Taken;
        $statBattle->kill = $request->kill;
        $statBattle->Critical = $request->Critical;
        $statBattle->Miss = $request->Miss;
        $statBattle->Health_remaining = $request->Health_remaining;
        $statBattle->save();
    }

    public function show($id) {
        return StatBattle::find($id);
    }
}
