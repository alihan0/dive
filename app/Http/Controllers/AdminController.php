<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Auth;
use Hash;
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

    public function new_admin(){
        return view('admin.new-admin');
    }

    public function admin_save(Request $request){
        if(empty($request->name) || empty($request->email) || empty($request->phone) || empty($request->password)){
            return response()->json(["type" => "warning", "message" => "Please fill all fields."]);
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return response()->json(["type" => "warning", "message" => "Please enter a valid email."]);
        }

        if(!is_numeric($request->phone)){
            return response()->json(["type" => "warning", "message" => "Please enter a valid phone number."]);
        }

        if(User::where('email', $request->email)->exists()){
            return response()->json(["type" => "warning", "message" => "Email already exists."]);
        }

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->is_admin = 1;
        $admin->password = Hash::make($request->password);
        $admin->status = 1;
        $admin->save();

        return response()->json(["type" => "success", "message" => "Admin added successfully.", "status" => true]);
    }

    public function remove_admin(Request $request){
        $admin = User::find($request->id);
        $admin->delete();

        return response()->json(["type" => "success", "message" => "Admin removed successfully.", "status" => true]);
    }

    public function all_user(){
        return view('admin.all-users', ['users' => User::where('is_admin',0)->get()]);
    }

    public function update_user(Request $request){
        if(empty($request->name) || empty($request->email)){
            return response()->json(["type" => "warning", "message" => "Please fill name and email fields"]);
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return response()->json(["type" => "warning", "message" => "Please enter a valid email."]);
        }

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->email_verification = $request->emailVerification;
        $user->discord_verification = $request->discordVerification;
        $user->gender_verification = $request->genderVerification;
        $user->save();

        return response()->json(["type" => "success", "message" => "User updated successfully.", "status" => true]);
    }

    public function remove_user(Request $request){
        $admin = User::find($request->id);
        $admin->delete();

        return response()->json(["type" => "success", "message" => "User removed successfully.", "status" => true]);
    }

    public function teams(){
        return view('admin.team', ['teams' => Team::all()]);
    }
}