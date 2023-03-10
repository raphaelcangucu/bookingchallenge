<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OccupancyController;

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

Route::controller(OccupancyController::class)->group(function () {
    Route::get('/daily-occupancy-rates/{date?}', 'dailyOccupancyRates');
    Route::get('/monthly-occupancy-rates/{date?}', 'monthlyOccupancyRates');
});

Route::resource('booking', BookingController::class);
