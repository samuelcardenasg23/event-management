<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('events', EventController::class);

// Means that every route about attendees, also has the event as the parameter
// so attendees can't exist on their own
Route::apiResource('events.attendees', AttendeeController::class)->scoped()->except(['update']);
