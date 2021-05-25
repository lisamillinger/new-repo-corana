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

Route::middleware('auth:api')->get('/people', function (Request $request) {
    return $request->people();
});

//VACCINATIONS
Route::get('vaccinations', [\App\Http\Controllers\VaccinationController::class, 'index']);
Route::get('vaccinations/{key}', [\App\Http\Controllers\VaccinationController::class, 'findByKey']);
Route::get('vaccinations/{id}', [\App\Http\Controllers\VaccinationController::class, 'findById']);
Route::get('vaccination/checkkey/{key}', [\App\Http\Controllers\VaccinationController::class, 'checkKey']);
Route::get('vaccinations/search/{searchTerm}', [\App\Http\Controllers\VaccinationController::class, 'findBySearchTerm']);
Route::put('vaccinations/{key}/{sv_number}', [\App\Http\Controllers\VaccinationController::class, 'registerPerson']);
Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);

//PEOPLE
Route::get('registrations', [\App\Http\Controllers\VaccinationController::class, 'indexPeople']);
Route::get('registrations/{id}', [\App\Http\Controllers\VaccinationController::class, 'findPersonById']);
Route::get('registrations/{sv_number}', [\App\Http\Controllers\VaccinationController::class, 'findPersonBySVNR']);
Route::get('registrations/checkid/{id}', [\App\Http\Controllers\VaccinationController::class, 'checkId']);
Route::get('registrations/{id}/vaccination', [\App\Http\Controllers\VaccinationController::class, 'getVaccinationForPerson']);
Route::put('registration/{sv_number}', [\App\Http\Controllers\VaccinationController::class, 'vaccinatePerson']);

Route::post('vaccination', [\App\Http\Controllers\VaccinationController::class, 'save']);
Route::put('vaccination/{key}', [\App\Http\Controllers\VaccinationController::class, 'update']);
Route::delete('vaccination/{key}', [\App\Http\Controllers\VaccinationController::class, 'delete']);
Route::post('auth/logout', [AuthController::class,'logout']);


//NUR FÜR ADMIN MÖGLICH
Route::group(['middleware' => ['api', 'auth.jwt']], function(){

});

