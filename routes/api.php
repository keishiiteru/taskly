<?php

use App\Http\Controllers\API\ReminderController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout',[AuthController::class, 'logout']);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('reminders', ReminderController::class);
});
