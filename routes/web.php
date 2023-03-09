<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', function () {
    return view('index');
});
Route::get('main', [HomeController::class, 'index']);
Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('register');
Route::get('forgot-password', [ForgotController::class, 'index'])->middleware('guest');
Route::post('forgot-password', [ForgotController::class, 'forgot'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [ResetController::class, 'index'])->middleware('guest')->name('password.reset');;
Route::post('reset-password', [ResetController::class, 'reset'])->middleware('guest')->name('password.update');
Route::get('login', [LoginController::class, 'index'])->middleware('guest');
Route::post('login', [LoginController::class, 'auth'])->middleware('guest')->name('login');
Route::post('save', [CertificateController::class, 'store'])->middleware('auth')->name('save');
Route::get('search', [SearchController::class, 'search'])->middleware('auth');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');