<?php

namespace App\Http\Controllers;

use App\Models\VerificationMeeting;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function app(){
        return view('app.index');
    }
    public function discord_verification(){
        return view('app.discord_verification');
    }
    public function birthday_gender_verification(){
        return view('app.birthday_gender_verification');
    }

    public function create_meeting(Request $request){

        if(empty($request->username)){
            return response()->json(["type" => "warning" , "message" => "Please Type Your Username"]);
        }elseif(empty($request->date1)){
            return response()->json(["type" => "warning" , "message" => "Please Type Your First Date"]);
        }elseif(empty($request->time1)){
            return response()->json(["type" => "warning" , "message" => "Please Type Your First Time"]);
        }

        $meet = VerificationMeeting::where('user', $request->user()->id)->first();
        
        if($meet && $meet->status != 1){
            return response()->json(["type" => "warning", "message" => "The meeting has already been held", "status" => false]);
        }

        $meet = new VerificationMeeting;
        $meet->user = $request->user()->id;
        $meet->username = $request->username;
        $meet->date1 = $request->date1;
        $meet->time1 = $request->time1;
        $meet->date2 = $request->date2;
        $meet->time2 = $request->time2;
        $meet->date3 = $request->date3;
        $meet->time3 = $request->time3;
        $meet->status = 1;

        if($meet->save()){
            return response()->json(["type" => "success", "message" => "The meeting has been held successfully", "status" => true]);
        }else{
            return response()->json(["type" => "warning", "message" => "The meeting has not been held successfully", "status" => false]);
        }
    }
}
