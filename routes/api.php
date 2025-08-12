<?php

use App\Http\Controllers\API\AuthController;
// use Illuminate\Http\Request;
use App\Http\Controllers\API\ConversationController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post("register", [AuthController::class,"register"])->name("register");
Route::post("login", [AuthController::class,"login"])->name("login");

Route::middleware(["auth:sanctum"])->group(function () {
    Route::apiResource("conversations", ConversationController::class);
});