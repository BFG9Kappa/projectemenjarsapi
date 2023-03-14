<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ComandaController;
use App\Http\Controllers\Api\ClientController;

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

// Afegir rutes a protegir
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('/clients', App\Http\Controllers\Api\ClientController::class);
});

Route::resource('/plats', App\Http\Controllers\Api\PlatController::class);
Route::resource('/ingredients', App\Http\Controllers\Api\IngredientController::class);
Route::resource('/comandes', App\Http\Controllers\Api\ComandesController::class);

Route::get('/comandes/{id}/plats', [App\Http\Controllers\Api\ComandesController::class, 'editPlats']);
Route::post('/comandes/{comanda}/assignplats', [App\Http\Controllers\Api\ComandesController::class, 'attachPlats'])->name('comandes.assignplats');
Route::post('/comandes/{comanda}/detachplats', [App\Http\Controllers\Api\ComandesController::class, 'detachPlats'])->name('comandes.detachplats');
