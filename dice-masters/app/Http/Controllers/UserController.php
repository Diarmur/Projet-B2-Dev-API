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

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update($id)
    {
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->password = request('password');
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json($user);
    }
    
}
