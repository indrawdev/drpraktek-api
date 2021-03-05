<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LetterController;

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
Route::get('/', [AuthController::class, 'index'])->name('/');

Route::get('/letter/referral/{uuid}', [LetterController::class, 'referral'])->name('letter.referral');
Route::get('/letter/health/{uuid}', [LetterController::class, 'health'])->name('letter.health');
Route::get('/letter/sick/{uuid}', [LetterController::class, 'sick'])->name('letter.sick');
Route::get('/letter/pregnant/{uuid}', [LetterController::class, 'pregnant'])->name('letter.pregnant');