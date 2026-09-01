<?php

use App\Http\Controllers\API\ReminderController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TaskOccurrenceController;
use App\Http\Controllers\API\TaskRecurrenceController;
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

    Route::post('tasks/{task}/recurrence', [TaskRecurrenceController::class, 'store']);
    Route::get('tasks/{task}/recurrence', [TaskRecurrenceController::class, 'show']);
    Route::put('tasks/{task}/recurrence', [TaskRecurrenceController::class, 'update']);
    Route::delete('tasks/{task}/recurrence', [TaskRecurrenceController::class, 'destroy']);

    Route::post('tasks/{task}/occurence', [TaskOccurrenceController::class, 'store']);
    Route::get('tasks/{task}/occurence', [TaskOccurrenceController::class, 'show']);
    Route::put('tasks/{task}/occurence', [TaskOccurrenceController::class, 'update']);
    Route::delete('tasks/{task}/occurence', [TaskOccurrenceController::class, 'destroy']);
});
