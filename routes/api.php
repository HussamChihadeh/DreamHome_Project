<?php

use App\Http\Controllers\Api\V1;
use App\Http\Controllers\Api\V1\DesignerController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\FurnitureController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v1", "namespace"=>"App\Http\Controllers\Api\V1"], function(){
    Route::post('/add-to-wishlist/{id}', 'UserController@addToWishlist');
    Route::get('/get-wishlist/{id}', 'UserController@getWishlist');
    Route::post('users', 'UserController@store');
    // Route::apiResource("users", UserController::class);
    Route::get('properties/getLocation', 'PropertyController@getLocation');
    Route::get('property/updateSlots', 'TourController@updateSlots');
    Route::put('properties/{id}', 'PropertyController@updatePropertyStatus');
    Route::apiResource("properties", PropertyController::class);
    Route::apiResource("furniture", FurnitureController::class);
    Route::apiResource("designers", DesignerController::class);
    Route::apiResource("chat", ChatController::class);
});

