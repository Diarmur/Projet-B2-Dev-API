<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Battle;
use App\Models\BattleHistory;

class BattleController extends Controller
{
    /**
     * @OA/Get(
     *    path="/api/battles",
     *    summary="Get all battles",
     *    tags={"Battles"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(response=401, description="Invalid credentials")
     * )
     */

    public function index() {
        return Battle::all();
    }

    /**
     * @OA\Post(
     *    path="/api/battles",
     *    summary="Create a new battle",
     *    tags={"Battles"},
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            @OA\Property(property="turnNB", type="integer", example=1),
     *            @OA\Property(property="duration", type="integer", example=60),
     *            @OA\Property(
     *              property="users_id",
     *              type="array",
     *            @OA\Items(type="integer"),
     *              example={1, 2}
     *            )
     *        )
     *    ),
     *    @OA\Response(response=201, description="Battle created successfully"),
     *    @OA\Response(response=401, description="Invalid credentials")
     * )
     *
     */

    public function store(Request $request) {
        $request->validate([
            'turnNB' => 'required|integer',
            'duration' => 'required|integer',
            'users_id' => 'required|array'
        ]);

        $battle = new Battle();
        $battle->turnNB = $request->turnNB;
        $battle->duration = $request->duration;
        $battle->save();

        foreach ($request->users_id as $user_id) {
            $battleHistory = new BattleHistory();
            $battleHistory->user_id = $user_id;
            $battleHistory->battle_id = $battle->id;
            $battleHistory->save();
        }

        return response()->json($battle, 201);
    }

    /**
     * @OA\Get(
     *    path="/api/battles/{id}",
     *    summary="Get a battle by id",
     *    tags={"Battles"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the battle",
     *        required=true,
     *        @OA\Schema(
     *            type="integer",
     *            format="int64"
     *        )
     *    ),
     *    @OA\Response(response=200, description="Battle found"),
     *    @OA\Response(response=401, description="Invalid credentials"),
     *    @OA\Response(response=404, description="Battle not found")
     * )
     */

    public function show($id) {
        $battle = Battle::find($id);

        if ($battle) {
            return $battle;
        } else {
            return response()->json(['error' => 'Battle not found'], 404);
        }
    }

}
