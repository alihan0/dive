<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view("land.index", ["sections" => Sections::where('page', 'index')->where('status',1)->get()]);
    }
}
