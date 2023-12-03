<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function login_control(Request $request){
        if (empty($request->email) || empty($request->password)) {
            return response()->json(["type" => "warning", "message" => "Please fill all fields."]);
        }
    
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(["type" => "warning", "message" => "Please enter a valid email."]);
        }
    
        // Basic authentication check
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication success
    
            // Check if the authenticated user is an admin
            if (Auth::user()->is_admin) {
                return response()->json(["type" => "success", "message" => "Admin login successful.", "status" => true]);
            } else {
                return response()->json(["type" => "warning", "message" => "Permission denied"]);
            }
        }
    
        // Authentication failed
        return response()->json(["type" => "error", "message" => "Invalid credentials."]);
    }
    
}
