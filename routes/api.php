<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/user")->group(function() {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::post('/logout', [UsersController::class, 'logout']);
});

Route::prefix('/note')->group(function (){
    Route::middleware('auth:sanctum')->put('/add', [NotesController::class, 'store']);
});

