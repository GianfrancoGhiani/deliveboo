<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
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

//restaurant api routes
Route::get('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurant/{id}/{slug}', [RestaurantController::class, 'show']);

//get single product
Route::get('product/{id}/{slug}', [RestaurantController::class, 'singleproduct']);




//ordering routes
Route::get('order', [OrderController::class, 'generate']);
Route::post('order/payment', [OrderController::class, 'makePayment']);
