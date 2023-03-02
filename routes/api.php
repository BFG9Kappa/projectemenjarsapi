<?php

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

Route::middleware('auth:sanctum')->group( function () {
    // Afegir rutes a protegir
    Route::resource('/clients', App\Http\Controllers\Api\ClientController::class);
});

Route::resource('/plats', App\Http\Controllers\Api\PlatController::class);
Route::resource('/ingredients', App\Http\Controllers\Api\IngredientController::class);
Route::resource('/comandes', App\Http\Controllers\Api\ComandesController::class);

