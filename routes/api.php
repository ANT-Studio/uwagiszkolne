<?php

use App\Http\Controllers\LikesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/user")->group(function() {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::post('/check', [UsersController::class, 'check']);
    Route::post('/logout', [UsersController::class, 'logout']);
    Route::middleware('auth:sanctum')->post('/change-password', [UsersController::class, 'changePassword']);
    Route::middleware('auth:sanctum')->post('/change-nick', [UsersController::class, 'changeNick']);
});

Route::prefix('/note')->group(function () {
    Route::middleware('auth:sanctum')->put('/add', [NotesController::class, 'store']);
    Route::middleware('auth:sanctum')->get('/own', [NotesController::class, 'own']);
    Route::get('/index', [NotesController::class, 'index']);
    Route::post('/ranking', [NotesController::class, 'ranking']);
    Route::get('/{id}', [NotesController::class, 'get']);
});

Route::prefix('/likes')->group(function () {
    Route::middleware('auth:sanctum')->put('/add', [LikesController::class, 'store']);
    Route::get('/index', [LikesController::class, 'index']);
    Route::delete('/{id}', [NotesController::class, 'destroy']);
});

