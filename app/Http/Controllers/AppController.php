<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\VerificationMeeting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function team(){
    return view('app.team', ['team' => TeamMember::where('user', Auth::id())->where('status', 1)->first()]);
    }

    public function new_team(){
        return view('app.new_team');
    }

    public function create_team(Request $request){

        $userInTeam = TeamMember::where('user', $request->id)->exists();

        if ($userInTeam) {
            return response()->json(['type'=> 'warning','message'=> 'You are already in a team']);
        }

        if(empty($request->team_name) || empty($request->team_abbreviation) || empty($request->role)){
            return response()->json(['type'=> 'warning','message'=> 'Please Type Your Team Name, Team Abbreviation and Your Role']);
        }

        $team = new Team;
        $team->name = $request->team_name;
        $team->description = $request->team_description;
        $team->abbreviation = $request->team_abbreviation;
        $team->owner = $request->id;
        $team->status = 1;
        if($team->save()){
            $member = new TeamMember;
            $member->team = $team->id;
            $member->user = $request->id;
            $member->role = $request->role;
            $member->status = 1;

            if($member->save()){
                return response()->json(['type'=> 'success','message'=> 'The team has been created successfully','status' => true]);
            }else{
                return response()->json(['type'=> 'warning','message'=> 'The team has not been created successfully']);
            }
        }
    }

    public function invite_team(Request $request){

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL) === false){
            return response()->json(['type'=> 'error','message'=> 'Please enter a valid email']);
        }

        if (InviteCode::where('email', $request->email)->where('status', 1)->first()) {
            return response()->json(['type'=> 'error', 'message'=> 'Already invited']);
        }


        $code = rand(100000, 999999);
    
        $invite = new InviteCode;
        $invite->code = $code;
        $invite->email = $request->email;
        $invite->team = $request->team;
        $invite->status = 1;
    
        if($invite->save()){
            $data = [
                'team' => Team::find($request->team)->name,
                'code' => $code
            ];
    
            // $request değişkenini use anahtar kelimesiyle içeriye ekleyerek erişim sağla
            Mail::send('mail.invite_code', $data, function ($message) use ($request) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_SENDERNAME'))
                        ->to($request->email)
                        ->subject('Invite Code');
            });

            return response()->json(['type'=> 'success','message'=> 'The invite code has been sent successfully', 'status' => true]);
        }
    }

    public function join_team(Request $request){
        $code = $request->code;

        if(strlen($code) < 6){
            return response()->json(['type'=> 'error','message'=> 'The code must be at least 6 characters']);
        }

        $invite = InviteCode::where('code', $code)->first();
        if(!$invite){
            return response()->json(['type'=> 'error','message'=> 'The code is invalid']);
        }

        if($invite->status != 1){
            return response()->json(['type'=> 'error','message'=> 'The code has been used before.']);
        }

        $invite->status = 0;
        $invite->save();

        $team = new TeamMember;
        $team->team = $invite->team;
        $team->user = Auth::user()->id;
        $team->role = 4;
        $team->status = 1;
        
        if($team->save()){
            return response()->json(['type'=> 'success','message'=> 'The team has been joined successfully', 'status' => true]);
        }else{
            return response()->json(['type'=> 'error','message'=> 'The team has not been joined successfully']);
        }
    }

    public function remove_team(Request $request){
        $team = Team::find($request->team);

        if (!$team) {
            return response()->json(['type' => 'error', 'message' => 'The team does not exist']);
        }

        $member = TeamMember::where('team', $request->team)->where('user', $request->user)->where('status', 1)->first();

        if (!$member) {
            return response()->json(['type' => 'error', 'message' => 'The member does not exist'.$request->team.$request->user]);
        }

        $member->status = 0;

        if ($member->save()) {
            return response()->json(['type' => 'success', 'message' => 'The member has been removed successfully', 'status' => true]);
        } else {
            return response()->json(['type' => 'error', 'message' => 'The member has not been removed successfully']);
        }
    }

    public function edit_team(Request $request){

        $team = Team::find($request->team);
        if (!$team) {
            return response()->json(['type' => 'error', 'message' => 'The team does not exist']);
        }

        $team->description = $request->desc;
        if($team->save()){
            return response()->json(['type' => 'success', 'message' => 'The team has been edited successfully', 'status' => true]);
        }else{
            return response()->json(['type' => 'error', 'message' => 'The team has not been edited successfully']);
        }
    }

    
}
