<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function app(){
        return view('app.index');
    }
    public function discord_verification(){
        return view('app.discord_verification');
    }
}
