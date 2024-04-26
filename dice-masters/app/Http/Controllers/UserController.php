<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users,200);
    }

    /**
     * @OA\Post(
     *     path="/api/user/{id}",
     *     summary="Create a new user",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the user",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response=201, description="User created successfully"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    /**
     * @OA\Put(
     *   path="/api/user/{id}",
     *   summary="Update a user",
     *   tags={"Users"},
     *   security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *     @OA\Schema(type="integer")
     * ),
     * @OA\Response(
    *          response=201,
    *          description="Data successfully added",
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="message", type="string", example="Data successfully added"),
    *          ),
    *      ),
    *      @OA\Response(
    *          response=422,
    *          description="Validation error",
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(property="message", type="string", example="The given data was invalid."),
    *              @OA\Property(property="errors", type="object"),
    *          ),
    *      ),
    *  )
    */

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|string|email',
            'password' => 'sometimes|string|confirmed'
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::find($id);
        $user->update($data);
        return response()->json($user, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/user/{id}",
     *     summary="Delete a user",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the user",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response=200, description="User deleted successfully"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json($user);
    }

}
