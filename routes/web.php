<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlatController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComandaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Plats
Route::get('/plats',[PlatController::class,'index']);
Route::get('/plats/new',[PlatController::class,'create']);
Route::post('/plats/save',[PlatController::class,'store']);
Route::get('/plats/show/{id}',[PlatController::class,'show']);
Route::get('/plats/update/{id}',[PlatController::class,'edit']);
Route::post('/plats/update/{id}',[PlatController::class,'update']);
Route::get('/plats/delete/{id}',[PlatController::class,'destroy']);

// Ingredients
Route::get('/ingredients',[IngredientController::class,'index']);
Route::get('/ingredients/new',[IngredientController::class,'create']);
Route::post('/ingredients/save',[IngredientController::class,'store']);
Route::get('/ingredients/update/{id}',[IngredientController::class,'edit']);
Route::post('/ingredients/update/{id}',[IngredientController::class,'update']);
Route::get('/ingredients/delete/{id}',[IngredientController::class,'destroy']);

// Comandes
Route::get('/comandes',[ComandaController::class,'index']);

// Clients
Route::get('/clients',[ClientController::class,'index']);
Route::get('/clients/new',[ClientController::class,'create']);
Route::post('/clients/save',[ClientController::class,'store']);
Route::get('/clients/update/{id}',[ClientController::class,'edit']);
Route::post('/clients/update/{id}',[ClientController::class,'update']);
Route::get('/clients/delete/{id}',[ClientController::class,'destroy']);