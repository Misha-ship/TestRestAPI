<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Other\CurrencyController;
use App\Http\Controllers\User\UserDestroyController;
use App\Http\Controllers\User\UserIndexController;
use App\Http\Controllers\User\UserShowController;
use App\Http\Controllers\User\UserStoreController;
use App\Http\Controllers\User\UserUpdateController;
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

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::get('currencies', CurrencyController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::prefix('users')->group(function () {
        Route::get('/', UserIndexController::class);
        Route::get('/{id}', UserShowController::class)->where('id', '[0-9]+');
        Route::post('/', UserStoreController::class);
        Route::put('/{id}', UserUpdateController::class)->where('id', '[0-9]+');
        Route::delete('/{id}', UserDestroyController::class)->where('id', '[0-9]+');
    });
});
