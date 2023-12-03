<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

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
    
    public function admins(){
        return view('admin.all-admin', ['admins' => User::where('is_admin', 1)->get()]);
    }

    public function admin_update(Request $request){
        if(empty($request->name) || empty($request->email) || empty($request->phone)){
            return response()->json(["type" => "warning", "message" => "Please fill all fields."]);
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return response()->json(["type" => "warning", "message" => "Please enter a valid email."]);
        }

        if(!is_numeric($request->phone)){
            return response()->json(["type" => "warning", "message" => "Please enter a valid phone number."]);
        }

        $admin = User::find($request->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();

        return response()->json(["type" => "success", "message" => "Admin updated successfully.", "status" => true]);
    }
}
