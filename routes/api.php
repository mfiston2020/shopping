<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\CountryController;
use App\Http\Controllers\Pages\UserController;
use App\Models\Product;
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

Route::post('/login',[AuthController::class,'login']);

Route::get('/',function(){
    return Product::all();
});

Route::get('/showCountries',[CountryController::class,'showCountries']);
Route::post('/saveCountry',[CountryController::class,'saveCountry']);

Route::post('/saveUser',[UserController::class,'saveUser']);
Route::get('/showUsers',[UserController::class,'showUsers']);
Route::post('/updateUser',[UserController::class,'updateUser']);
Route::get('/showUser/{id}',[UserController::class,'showUser']);
Route::delete('/delete/User/{id}',[UserController::class,'deleteUser']);
