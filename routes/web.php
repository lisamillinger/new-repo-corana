<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Models\Vaccination;
use App\Models\Location;

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

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::get('/', [\App\Http\Controllers\VaccinationController::class,'index']);
Route::get('/vaccinations', [\App\Http\Controllers\VaccinationController::class,'index']);
Route::get('vaccinations/{vaccination}',[\App\Http\Controllers\VaccinationController::class,'show']);
Route::get('/', [\App\Http\Controllers\VaccinationController::class,'index']);
Route::get('/registrations', [\App\Http\Controllers\VaccinationController::class,'index']);
Route::get('registrations/{registration}',[\App\Http\Controllers\VaccinationController::class,'show']);


