<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlatController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ClientController;

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

// Ingredients
Route::get('/ingredients',[IngredientController::class,'index']);
Route::get('/ingredients/new',[IngredientController::class,'create']);


// Clients
Route::get('/clients',[ClientController::class,'index']);


// Comandes