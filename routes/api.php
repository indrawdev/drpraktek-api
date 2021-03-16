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
	Route::post('/login', [AuthController::class, 'login'])->name('login');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::middleware('auth:sanctum')->group(function () {

	Route::post('/approved', [RegisterController::class, 'approved'])->name('approved');
	Route::post('/rejected', [RegisterController::class, 'rejected'])->name('rejected');

	Route::get('/users', [UserController::class, 'index'])->name('users');
	Route::get('/user/{id}', [UserController::class, 'show']);
	Route::post('/user', [UserController::class, 'store']);
	Route::put('/user/{id}', [UserController::class, 'update']);
	Route::delete('/user/{id}', [UserController::class, 'destroy']);
	Route::post('/user/reset', [UserController::class, 'reset']);

	Route::get('/clinics', [ClinicController::class, 'index'])->name('clinics');
	Route::get('/clinic/{id}', [ClinicController::class, 'show']);
	Route::post('/clinic', [ClinicController::class, 'store']);
	Route::put('/clinic/{id}', [ClinicController::class, 'update']);
	Route::delete('/clinic/{id}', [ClinicController::class, 'destroy']);

	Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurances');
	Route::get('/insurance/{id}', [InsuranceController::class, 'show']);
	Route::post('/insurance', [InsuranceController::class, 'store']);
	Route::put('/insurance/{id}', [InsuranceController::class, 'update']);
	Route::delete('/insurance/{id}', [InsuranceController::class, 'destroy']);

	Route::get('/fees', [FeeController::class, 'index'])->name('fees');
	Route::get('/fee/{id}', [FeeController::class, 'show']);
	Route::post('/fee', [FeeController::class, 'store']);
	Route::put('/fee/{id}', [FeeController::class, 'update']);
	Route::delete('/fee/{id}', [FeeController::class, 'destroy']);

	Route::get('/patients', [PatientController::class, 'index'])->name('patients');
	Route::get('/patient/{id}', [PatientController::class, 'show']);
	Route::post('/patient', [PatientController::class, 'store']);
	Route::put('/patient/{id}', [PatientController::class, 'update']);
	Route::delete('/patient/{id}', [PatientController::class, 'destroy']);

	Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations');
	Route::get('/registration/{id}', [RegistrationController::class, 'show']);
	Route::post('/registration', [RegistrationController::class, 'store']);
	Route::put('/registration/{id}', [RegistrationController::class, 'update']);
	Route::delete('/registration/{id}', [RegistrationController::class, 'destroy']);

	Route::get('/medicals', [MedicalController::class, 'index'])->name('medicals');
	Route::get('/medical/{id}', [MedicalController::class, 'show']);
	Route::post('/medical', [MedicalController::class, 'store']);
	Route::put('/medical/{id}', [MedicalController::class, 'update']);
	Route::delete('/medical/{id}', [MedicalController::class, 'destroy']);

	Route::get('/letters', [LetterController::class, 'index'])->name('letters');
	Route::get('/letter/{id}', [LetterController::class, 'show']);
	Route::post('/letter', [LetterController::class, 'store']);
	Route::put('/letter/{id}', [LetterController::class, 'update']);
	Route::delete('/letter/{id}', [LetterController::class, 'destroy']);

});