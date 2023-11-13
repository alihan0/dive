<?php

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


Route::get('/get-user-roles/{username}', function ($username) {

    // Replace with your actual bot token
    $botToken = 'MTE3Mjk0MDY3NTk0MDExMDMzNg.GAWGxy.01O7gaZYDSN6QQI6sKILWVG01ZC-FP4keX0jmI';

    $guildId = '1131929783119380480';
    $discordApiUrl = 'https://discord.com/api/v10';
    $verified_role_id = "1136912252662980658";

    // Get the user ID by username
    $userIdResponse = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => "Bot $botToken"])->get("$discordApiUrl/guilds/$guildId/members/search?query=$username");
    $userData = $userIdResponse->json();

    

    if (in_array($verified_role_id, $userData[0]["roles"])) {
        echo "İstenilen rol bulundu!";
    } else {
        echo "İstenilen rol bulunamadı.";
    }
    

    //return $userData;

});



Route::controller(DiscordController::class)->prefix('discord')->group(function(){
   Route::get('/guild', 'guild'); 
   Route::get('/guild/roles', 'guild_roles');
   Route::get('/role_control/{username}', 'role_control');
   Route::post('/check_role', 'check_role'); 
});