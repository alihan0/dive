<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'login_control');
    Route::get('/register', 'register');
    Route::post('/register', 'register_control');
    Route::get('/logout', 'logout');
    Route::get('/login/admin', 'admin_login');
    Route::post('/login/admin', 'admin_login_control');

    Route::get('/verification/email', 'verification_email')->middleware('auth');
    Route::post('/verification/verify_email', 'verify_email')->middleware('auth');
});

Route::controller(AppController::class)->prefix('app')->middleware('auth')->group(function(){
    Route::get('/', 'app');
});