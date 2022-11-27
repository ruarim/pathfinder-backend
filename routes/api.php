<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\AttributeController;
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
Route::resources([
    'venues' => VenueController::class,
    'attributes' => AttributeController::class
]);
Route::get('attributes_search', [VenueController::class, 'attributes_search']);
Route::get('name_search', [VenueController::class, 'name_search']);
