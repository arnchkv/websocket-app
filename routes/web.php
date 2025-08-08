<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('demo');
// });

Route::get("/", [DemoController::class, "index"])->name("home");
Route::post("/create", [DemoController::class,"create"])->name("create");

Broadcast::routes();