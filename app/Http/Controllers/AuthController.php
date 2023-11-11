<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('app.login');
    }
    public function register(){
        return view('app.register');
    }
    public function register_control(Request $request){
        if(empty($request->name) || empty($request->email) || empty($request->password) || empty($request->gender) || empty($request->birthdate)){
            return response()->json(["type"=>"warning","message" => "All fields are required."]);
        }else{
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                return response()->json(["type"=>"warning","message" => "Please enter a valid email."]);
            }elseif(User::where('email', $request->email)->first()){
                return response()->json(["type"=>"warning","message" => "The email has been registered."]);
            }else{
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'status' => 1
                ]);

                if($user){
                    return response()->json(["type"=>"success","message" => "Your account has been created.","status"=>true]);
                }else{
                    return response()->json(["type"=>"warning","message" => "Something went wrong."]);
                }
            }
        }
    }
}
