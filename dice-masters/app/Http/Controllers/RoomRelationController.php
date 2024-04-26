<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRelation;

class RoomRelationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/roomRelations",
     *     summary="Get a list of rooms relations",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $rooms = RoomRelation::all();
        return response()->json($rooms,200);
    }

    /**
     * @OA\Post(
     *      path="/api/roomRelations",
     *      summary="Link a player to a room",
     *      tags={"Rooms"},
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass player id and room id",
     *          @OA\JsonContent(
     *              required={"room_id", "user_id"},
     *              @OA\Property(property="room_id", type="integer", example="1"),
     *              @OA\Property(property="user_id", type="integer", example="1")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Data successfully added",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="Data successfully added")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object")
     *          )
     *      )
     * )
     */
public function store(Request $request)
    {
        $roomRelation = new RoomRelation();
        $roomRelation->room_id = $request->room_id;
        $roomRelation->user_id = $request->user_id;
        $roomRelation->save();

        return response()->json([
            'message' => 'Data successfully added',
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/roomRelations/room/{id}",
     *     summary="Get a all players id in a room",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the room relation",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function showRoom($id){
        $roomRelations = RoomRelation::where('room_id', $id)->pluck('user_id');
        return response()->json($roomRelations, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/roomRelations/user/{id}",
     *     summary="Get a room by user id",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Room not found")
     * )
     */

    public function show($id)
    {
        $roomRelation = RoomRelation::where('user_id', $id)->first();
        if ($roomRelation) {
            $room = Room::find($roomRelation->room_id);
            return response()->json($room, 200);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }
}
