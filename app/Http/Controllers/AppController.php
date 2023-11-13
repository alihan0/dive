<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\VerificationMeeting;
use Auth;
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

    public function team(){
       // Kullanıcının takıma dahil olup olmadığını kontrol et
    $userTeamMember = TeamMember::where('user', Auth::id())->first();

    // Eğer kullanıcı bir takıma üye ise
    if ($userTeamMember) {
        // Kullanıcının dahil olduğu takımın verilerini al
        $team = $userTeamMember->team;

        // Blade'e verileri gönder
        return view('app.team', compact('team'));
    }

    // Kullanıcı bir takıma üye değilse
    return view('app.team', ['team' => null]);
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
}
