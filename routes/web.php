<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TournamentController;
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
    Route::post('/upload/cover', 'upload_cover');
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

    Route::get('/tournaments', 'tournaments');
    Route::get('/tournament/detail/{id}', 'tournament_detail');
    Route::post('/tournament/apply', 'apply_tournament');

    Route::get('/matches', 'matches');
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
    Route::post('/user/remove', 'remove_user');

    Route::get('/team', 'teams');
    Route::get('/team/detail/{id}', 'team_detail');

    Route::get('/calendar', 'calendar');

    Route::get('/tournament/all', 'all_tournaments');
    Route::get('/tournament/new', 'new_tournament');
    Route::post('/tournament/create', 'create_tournament');
    Route::get('/tournament/active', 'active_tournaments');
    Route::get('/tournament/pending', 'pending_tournaments');
    Route::get('/tournament/detail/{id}', 'detail_tournament');

    Route::post('/tournament/setPublish', 'set_publish');
    Route::post('/tournament/setStatus', 'set_status');
    Route::post('/tournament/remove', 'remove');
    Route::post('/tournament/setMatch', 'set_match');
    Route::post('/tournament/setMatchTime', 'set_match_time');
    Route::post('/tournament/setWinner', 'set_winner');
    Route::post('/tournament/removeMatch', 'remove_match');
    Route::post('/tournament/nextRound', 'next_round');
    Route::post('/tournament/completeGame', 'complete_game');
});

Route::get('/admin/login', [AdminController::class,'login']);
Route::post('/admin/login', [AdminController::class,'login_control']);