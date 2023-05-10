<?php

use App\Http\Controllers\Api\V1;
use App\Http\Controllers\Api\V1\DesignerController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\FurnitureController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\UserController;
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
    Route::get('properties/getLatestProperties', 'PropertyController@getLatestProperties');

    Route::get('property/updateSlots', 'TourController@updateSlots');
    Route::get('property/tourRequests', 'TourController@index');
    Route::put('properties/{id}', 'PropertyController@updatePropertyStatus');
    Route::put('properties/assign/{id}', 'PropertyController@assignProperty');
    Route::get('furniture/filterData', 'FurnitureController@filterData');
    Route::post('furniture/storeItem', 'FurnitureController@storeItem');
    Route::post('designers/storeDesigner', 'DesignerController@storeDesigner');
    Route::delete('designers/deleteDesigner/{id}', 'DesignerController@deleteDesigner');
    Route::post('furniture/addToCart', 'CartController@addToCart');
    Route::get('furniture/getRecommendedProducts', 'FurnitureController@getRecommendedProducts');
    Route::get('properties/getPropertiesCount', 'PropertyController@getPropertiesCount');
    Route::get('users/getCustomersCount', 'UserController@getCustomersCount');
    // getRecommendedProducts

    Route::apiResource("properties", PropertyController::class);
    Route::apiResource("users", UserController::class);
    Route::apiResource("furniture", FurnitureController::class);
    Route::apiResource("designers", DesignerController::class);
    Route::apiResource("chat", ChatController::class);
    Route::get('designers/getDesigner_Details', 'DesignerController@getDesigner_Details');

});

