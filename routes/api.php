<?php

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

Route::post("/login", [\App\Http\Controllers\UserController::class, 'login']);
Route::get("/elements", [\App\Http\Controllers\ElementsController::class, 'all']);

Route::middleware('auth.api')->group(function () {
    Route::get("/projects", [\App\Http\Controllers\ProjectsController::class, 'all']);
    Route::get("/projects/{id}", [\App\Http\Controllers\ProjectsController::class, 'one']);
    Route::post("/projects", [\App\Http\Controllers\ProjectsController::class, 'create']);
    Route::patch("/projects/{id}", [\App\Http\Controllers\ProjectsController::class, 'update']);
});
