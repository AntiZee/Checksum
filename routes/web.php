<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
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
Auth::routes(['reset' => true]);
Route::get('', function () {
    return view('index');
});
Route::get('main', [HomeController::class, 'index']);
Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::get('reset', [ResetController::class, 'index']);
Route::post('reset', [ResetController::class, 'reset'])->name('reset');
Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'auth'])->name('login');
Route::post('save', [CertificateController::class, 'store'])->name('save');
Route::get('search', [SearchController::class, 'search']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');