<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\PathController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::resources([
    'venues' => VenueController::class, //@dev remove
    'venues.show' => VenueController::class,
    'attributes' => AttributeController::class,
]);


Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get("", [UserController::class, 'index']);
    Route::get("/{id}", [UserController::class, 'show']);
});

Route::get('venues/{id}/reviews', [VenueController::class, 'get_reviews']);

Route::group(['prefix' => 'venues', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{venue}/rating', [VenueController::class, 'get_rating']);
    Route::post('/{venue}/rate', [VenueController::class, 'rate']);
    Route::post('/{venue}/favourite', [VenueController::class, 'favourite']);
    Route::get('/{venue}/favourited', [VenueController::class, 'get_favourite']);
    Route::get('/user/favourites', [VenueController::class, 'get_user_favourites']);
    Route::post('/{venue}/review', [VenueController::class, 'add_review']);
});

Route::get('paths/{id}', [PathController::class, 'show']);

Route::group(['prefix' => 'paths', 'middleware' => 'auth:sanctum'], function () {
    Route::post('', [PathController::class, 'store']);
    Route::post('/{id}/completed', [PathController::class, 'completed']);
    Route::post('/{id}/participants', [PathController::class, 'update_participants']);
    Route::get('/{path}/rating', [PathController::class, 'get_rating']);
    Route::post('/{path}/rate', [PathController::class, 'rate']);
});

Route::get('venue_attributes_search', [VenueController::class, 'attributes_search']);
Route::get('venue_name_search', [VenueController::class, 'name_search']);
Route::get("user_email_search", [UserController::class, 'email_search']);
