<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\LetterController;

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

Route::get('/', [AuthController::class, 'index'])->name('/');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
	Route::post('/login', [AuthController::class, 'login'])->name('login');
	Route::post('/register', [AuthController::class, 'register'])->name('register');
	Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
	Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot');

Route::middleware('auth:api')->group(function () {

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

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctor');
Route::post('/doctor', [DoctorController::class, 'store'])->name('doctor');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor');
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor');

Route::get('/officers', [OfficerController::class, 'index'])->name('officers');
Route::get('/officer/{id}', [OfficerController::class, 'show'])->name('officer');
Route::post('/officer', [OfficerController::class, 'store'])->name('officer');
Route::put('/officer/{id}', [OfficerController::class, 'update'])->name('officer');
Route::delete('/officer/{id}', [OfficerController::class, 'destroy'])->name('officer');

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
