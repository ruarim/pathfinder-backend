<?php

use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->name('dashboard');

Route::prefix('venues')->group(function () {
    Route::get('', [VenueController::class, 'index'])->name('venues');
    Route::get('create-venue', [VenueController::class, 'create_venue'])->name('create-venue');
});
