<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/chat/send', [MessageController::class, 'send']);
Route::middleware('auth:sanctum')->get('/chat/{id}/messages', function ($id) {
    return Message::where('chat_id', $id)->with('user')->get();
});

