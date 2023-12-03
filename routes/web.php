<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscordController;
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
    Route::post('/upload', 'upload');
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
    Route::get('/verification/discord', 'discord_verification');
    Route::get('/verification/v2/discord', 'discord_verification_v2');
    Route::get('/verification/v2/discord/confirmation', 'discord_verification_confirmation');
    Route::get('/verification/birthday-gender', 'birthday_gender_verification');
    Route::post('/create-meeting', 'create_meeting');
    Route::get('/team', 'team');
    Route::get('/team/new', 'new_team');
    Route::post('/team/create', 'create_team');
    Route::post('/team/invite', 'invite_team');
    Route::post('/team/join', 'join_team');
    Route::post('/team/remove', 'remove_team');
    Route::post('/team/edit', 'edit_team');
    Route::post('/team/leave', 'leave_team');
});


Route::controller(DiscordController::class)->prefix('discord')->group(function(){
   Route::get('/guild', 'guild'); 
   Route::get('/guild/roles', 'guild_roles');
   Route::get('/role_control/{username}', 'role_control');
   Route::post('/check_role', 'check_role'); 
});


Route::controller(AdminController::class)->prefix('admin')->middleware('admin')->group(function(){
    Route::get('/', 'index');
    Route::get('/account/all', 'admins');
    Route::get('/account/new', 'new_admin');
    Route::post('/account/update', 'admin_update');
    Route::post('/account/new', 'admin_save');
    Route::post('/account/remove', 'remove_admin');

    Route::get('/user/all', 'all_user');
    Route::post('/user/update', 'update_user');
});

Route::get('/admin/login', [AdminController::class,'login']);
Route::post('/admin/login', [AdminController::class,'login_control']);