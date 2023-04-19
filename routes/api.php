<?php

use App\Http\Controllers\ShiftWorkerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkShiftController;
use App\Http\Requests\LoginRequest;
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

Route::post('login', [UserController::class, "login"])->withoutMiddleware("auth:api");
Route::get('logout', [UserController::class, "logout"]);


Route::middleware(['can:admin, App\Models\User'])->group(function () {
    Route::get('user', [UserController::class, "index"]);
    Route::post('user', [UserController::class, "create"]);
    Route::get('user/{user}', [UserController::class, "show"]);
    Route::post('work-shift', [WorkShiftController::class, "create"]);
    Route::get('work-shift/{work}/open', [WorkShiftController::class, "open"]);
    Route::get('work-shift/{work}/close', [WorkShiftController::class, "close"]);
    Route::post('work-shift/{work}/user', [ShiftWorkerController::class, "create"]);
    Route::post('work-shift/{work}/order', [ShiftWorkerController::class, "create"]);
});


Route::middleware(['can:waiter, App\Models\User'])->group(function () {

});


Route::middleware(['can:cook, App\Models\User'])->group(function () {

});
