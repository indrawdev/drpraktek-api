<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\LetterController;

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'auth'], function () {
	Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
	Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
	Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::middleware('auth:sanctum')->group(function () {

	Route::post('/register', [RegisterController::class, 'store'])->name('register');

	Route::get('/users', [UserController::class, 'index'])->name('users');
	Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
	Route::post('/user', [UserController::class, 'store'])->name('user');
	Route::put('/user/{id}', [UserController::class, 'update'])->name('user');
	Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user');

	Route::get('/clinics', [ClinicController::class, 'index'])->name('clinics');
	Route::get('/clinic/{id}', [ClinicController::class, 'show'])->name('clinic');
	Route::post('/clinic', [ClinicController::class, 'store'])->name('clinic');
	Route::put('/clinic/{id}', [ClinicController::class, 'update'])->name('clinic');
	Route::delete('/clinic/{id}', [ClinicController::class, 'destroy'])->name('clinic');

	Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurances');
	Route::get('/insurance/{id}', [InsuranceController::class, 'show'])->name('insurance');
	Route::post('/insurance', [InsuranceController::class, 'store'])->name('insurance');
	Route::put('/insurance/{id}', [InsuranceController::class, 'update'])->name('insurance');
	Route::delete('/insurance/{id}', [InsuranceController::class, 'destroy'])->name('insurance');

	Route::get('/fees', [FeeController::class, 'index'])->name('fee');
	Route::get('/fee/{id}', [FeeController::class, 'show'])->name('fee');
	Route::post('/fee', [FeeController::class, 'store'])->name('fee');
	Route::put('/fee/{id}', [FeeController::class, 'update'])->name('fee');
	Route::delete('/fee/{id}', [FeeController::class, 'destroy'])->name('fee');

	Route::get('/patients', [PatientController::class, 'index'])->name('patients');
	Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patient');
	Route::post('/patient', [PatientController::class, 'store'])->name('patient');
	Route::put('/patient/{id}', [PatientController::class, 'update'])->name('patient');
	Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('patient');

	Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations');
	Route::get('/registration/{id}', [RegistrationController::class, 'show'])->name('registration');
	Route::post('/registration', [RegistrationController::class, 'store'])->name('registration');
	Route::put('/registration/{id}', [RegistrationController::class, 'update'])->name('registration');
	Route::delete('/registration/{id}', [RegistrationController::class, 'destroy'])->name('registration');

	Route::get('/medicals', [MedicalController::class, 'index'])->name('medicals');
	Route::get('/medical/{id}', [MedicalController::class, 'show'])->name('medical');
	Route::post('/medical', [MedicalController::class, 'store'])->name('medical');
	Route::put('/medical/{id}', [MedicalController::class, 'update'])->name('medical');
	Route::delete('/medical/{id}', [MedicalController::class, 'destroy'])->name('medical');

	Route::get('/letters', [LetterController::class, 'index'])->name('letters');
	Route::get('/letter/{id}', [LetterController::class, 'show'])->name('letter');
	Route::post('/letter', [LetterController::class, 'store'])->name('letter');
	Route::put('/letter/{id}', [LetterController::class, 'update'])->name('letter');
	Route::delete('/letter/{id}', [LetterController::class, 'destroy'])->name('letter');

});

Route::middleware('auth:sanctum')->get('/user-profile', function (Request $request) {
	return $request->user();
});