<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\EmailVerificationCodes;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(){
        return view('app.login');
    }
    public function login_control(Request $request){
        if(empty($request->email) || empty($request->password)){
            return response()->json(["type"=>"warning","message" => "All fields are required."]);
        }else{
     
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json([
                    "type" => "success",
                    "message" => "You are logged in!",
                    "status" => true
                ]);
            }else{
                return response()->json(["type"=>"warning","message" => "The email or password is incorrect."]);
            }
     
    
        }
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
                    'email_verification' => 0,
                    'discord_verification' => 0,
                    'gender_verification' => 0,
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

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/app');
    }

    public function verification_email(){

        $code = rand(100000, 999999);

    
        $verify = new EmailVerificationCodes;
        $verify->user = Auth::user()->id;
        $verify->code = $code;
        $verify->status = 1;

        if($verify->save()){
            $data = [
                'name' => Auth::user()->name,
                'code' => $code
            ];
    
    
            Mail::send('mail.email_verification', $data, function ($message) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_SENDERNAME'))
                        ->to(Auth::user()->email)
                        ->subject('Email Verification');
            });
        
    
    
            return view('app.verification_email');
        }

        
    }

    public function verify_email(Request $request){
        if(empty($request->code)){
            return response()->json(['type'=> 'error','message'=> 'Code is required.']);
        }else{
            $verify = EmailVerificationCodes::where('user', Auth::user()->id)->where('code', $request->code)->where('status', 1)->first();

            $user = User::where('id', Auth::user()->id)->first();

            if($verify){
                $verify->status = 2;
                $user->email_verification = 1;
                $user->save();
                if($verify->save()){
                    return response()->json(['type'=> 'success','message'=> 'Your email has been verified.', "status" => true]);
                }else{
                    return response()->json(['type'=> 'error','message'=> 'Something went wrong.']);
                }
            }else{
                return response()->json(['type'=> 'error','message'=> 'Invalid code.']);
            }
        }
    }
}
