<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vaccinations', [\App\Http\Controllers\VaccinationController::class, 'index']);

Route::get('/vaccination/{key}', [\App\Http\Controllers\VaccinationController::class, 'findByKey']);

Route::get('vaccination/checkkey/{key}', [\App\Http\Controllers\VaccinationController::class, 'checkKey']);

Route::get('vaccinations/search/{searchTerm}', [\App\Http\Controllers\VaccinationController::class, 'findBySearchTerm']);

Route::post('vaccination', [\App\Http\Controllers\VaccinationController::class, 'save']);

Route::put('vaccination/{key}', [\App\Http\Controllers\VaccinationController::class, 'update']);

Route::delete('vaccination/{key}', [\App\Http\Controllers\VaccinationController::class, 'delete']);

