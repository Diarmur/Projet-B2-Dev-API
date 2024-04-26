<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharacterSheet;

class CharacterSheetController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/characterSheets",
     *      summary="Get all character sheets",
     *      tags={"Character Sheets"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="List of all character sheets"),
     *      @OA\Response(response=401, description="Invalid credentials")
     * )
     */
    public function index() {
        return CharacterSheet::all();
    }

    /**
     * @OA\Post(
     *      path="/api/characterSheets",
     *      summary="Create a new character sheet",
     *      tags={"Character Sheets"},
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="character_name", type="string",example="John Doe"),
     *              @OA\Property(property="user_id", type="integer",example=1),
     *              @OA\Property(property="race", type="string",example="Human"),
     *              @OA\Property(property="class", type="string",example="fighter"),
     *              @OA\Property(property="level", type="integer",example=3),
     *              @OA\Property(property="background", type="string",example="noble"),
     *              @OA\Property(property="alignment", type="string",example="neutral"),
     *              @OA\Property(property="experience", type="integer",example=200),
     *              @OA\Property(property="strength", type="integer",example=10),
     *              @OA\Property(property="dexterity", type="integer",example=10),
     *              @OA\Property(property="constitution", type="integer",example=10),
     *              @OA\Property(property="intelligence", type="integer",example=10),
     *              @OA\Property(property="wisdom", type="integer",example=10),
     *              @OA\Property(property="charisma", type="integer",example=10),
     *              @OA\Property(property="hit_points", type="integer",example=20),
     *              @OA\Property(property="armor_class", type="integer",example=15),
     *              @OA\Property(property="speed", type="integer",example=9),
     *              @OA\Property(property="spell_book", type="string",example="fireball, magic missile, wish")
     *          )
     *      ),
     *      @OA\Response(response=201, description="Character sheet created successfully"),
     *      @OA\Response(response=401, description="Invalid credentials")
     * )
    */

    public function store(Request $request) {
        $request->validate([
            'character_name' => 'required|string',
            'user_id' => 'required|integer',
            'race' => 'required|string',
            'class' => 'required|string',
            'level' => 'required|integer',
            'background' => 'required|string',
            'alignment' => 'required|string',
            'experience' => 'required|integer',
            'strength' => 'required|integer',
            'dexterity' => 'required|integer',
            'constitution' => 'required|integer',
            'intelligence' => 'required|integer',
            'wisdom' => 'required|integer',
            'charisma' => 'required|integer',
            'hit_points' => 'required|integer',
            'armor_class' => 'required|integer',
            'speed' => 'required|integer',
            'spell_book' => 'string'
        ]);

        $characterSheet = new CharacterSheet([
            'character_name' => $request->character_name,
            'user_id' => $request->user_id,
            'race' => $request->race,
            'class' => $request->class,
            'level' => $request->level,
            'background' => $request->background,
            'alignment' => $request->alignment,
            'experience' => $request->experience,
            'strength' => $request->strength,
            'dexterity' => $request->dexterity,
            'constitution' => $request->constitution,
            'intelligence' => $request->intelligence,
            'wisdom' => $request->wisdom,
            'charisma' => $request->charisma,
            'hit_points' => $request->hit_points,
            'armor_class' => $request->armor_class,
            'speed' => $request->speed,
            'spell_book' => $request->spell_book
        ]);

        $characterSheet->save();

        return response()->json($characterSheet,201);
    }

    /**
     * @OA\Get(
     *      path="/api/characterSheets/{id}",
     *      summary="Get a character sheet by id",
     *      tags={"Character Sheets"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the character sheet",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="Character sheet found"),
     *      @OA\Response(response=404, description="Character sheet not found")
     * )
     */

    public function show($id) {
        $characterSheet = CharacterSheet::find($id);

        if ($characterSheet) {
            return $characterSheet;
        } else {
            return response()->json([
                'message' => 'Character sheet not found'
            ],404);
        }
    }

    /**
     * @OA/Get(
     *     path="/api/characterSheets/user/{id}",
     *     summary="Get all character sheets for a user",
     *     tags={"Character Sheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the user",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="List of all character sheets for a user"),
     *      @OA\Response(response=404, description="Character sheets not found")
     *  )
     */

     public function userSheet($id){
        $characterSheets = CharacterSheet::where('user_id',$id)->select('id','character_name','class')->get();

        return $characterSheets;
    }


}
