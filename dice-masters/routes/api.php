<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomRelationController;

Route::middleware(['auth:sanctum','web'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/rooms', [RoomController::class, 'index']);
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::get('/rooms/{id}', [RoomController::class, 'show']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    Route::get('/roomRelations', [RoomRelationController::class, 'index']);
    Route::post('/roomRelations', [RoomRelationController::class, 'store']);
    Route::get('/roomRelations/room/{id}', [RoomRelationController::class, 'showRoom']);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::get('/guest', [AuthController::class, 'guest'])->name('guest');
