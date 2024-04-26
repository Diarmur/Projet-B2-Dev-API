<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRelation;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/rooms",
     *     summary="Get a list of rooms",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms,200);
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     summary="Create a new room",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="host_id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Room created successfully"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

     public function store(Request $request)
     {
         $request->validate([
             'code' => 'required|string|unique:rooms,code',
             'host_id' => 'required|integer|exists:users,id|unique:rooms,hostId',
         ]);
     
         $room = new Room([
             'code' => $request->code,
             'hostId' => $request->host_id,
         ]);

         $room->save();

         $link = new RoomRelation([
             'room_id' => $room->id,
             'user_id' => $request->host_id,
         ]);

         $link->save();

         return response()->json([$room,$link],201);
     }

    /**
     * @OA\Get(
     *     path="/api/rooms/{id}",
     *     summary="Get a room",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *    @OA\Parameter(
     *         name="id",
     *        in="path",
     *        required=true,
     *      description="ID of the room",
     *     @OA\Schema(type="integer")
     * ),
     *    @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function show($id)
    {
        $room = Room::find($id);

        return response()->json($room,200);
    }

    /**
     * @OA\Delete(
     *     path="/api/rooms/{id}",
     *     summary="Delete a room",
     *     tags={"Rooms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the room",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Room deleted successfully"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return response()->json(null,204);
    }
}
