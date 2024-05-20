<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Done
Route::post('login', AuthController::class)->name('login'); 

Route::prefix('irrigation')->middleware('auth:sanctum')->group(function(){
    Route::post('zones', [ZoneController::class, 'store']);

    Route::get('zones', [ZoneController::class, 'index']);

    Route::get('zones/{zoneId}', [ZoneController::class, 'show']);
    
    Route::put('zones/{zoneId}', [ZoneController::class, 'update']);

    Route::delete('zones/{zoneId}', [ZoneController::class, 'destroy']);

    Route::post('zones/{zoneId}/schedules', [ScheduleController::class, 'store']);

    Route::get('zones/{zoneId}/schedules', [ScheduleController::class, 'index']);

    Route::get('zones/{zoneId}/schedules/{scheduleId}', [ScheduleController::class, 'show']);

    Route::put('zones/{zoneId}/schedules/{scheduleId}', [ScheduleController::class, 'update']);

    Route::delete('zones/{zoneId}/schedules/{scheduleId}', [ScheduleController::class, 'destroy']);

 
});
