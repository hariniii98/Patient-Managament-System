<?php

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
use App\Http\Controllers\PatientsController;



Route::resource('patients', PatientsController::class);
Route::get('patient-report/{id}','App\Http\Controllers\PatientsReportsController@index')->name('patients.report');
Route::post('/add-report','App\Http\Controllers\PatientsReportsController@store')->name('patients.reports.add');


