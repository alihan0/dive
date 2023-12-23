<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TournamentMatches;
use App\Models\TournamentMatchTimes;
use App\Models\TournamentParticipant;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Tournament;
use Carbon\Carbon;

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

    public function team_detail($id){
        return view('admin.team-detail', ['team' => Team::find($id)]);
    }

    public function calendar(){
        return view('admin.calendar');
    }

    public function all_tournaments(){
        return view('admin.all-tournaments', ['tournaments' => Tournament::all()]);
    }

    public function active_tournaments(){
        return view('admin.active-tournaments', ['tournaments' => Tournament::where('status',2)->get()]);
    }

    public function pending_tournaments(){
        return view('admin.pending-tournaments', ['tournaments' => Tournament::where('status',1)->get()]);
    }

    public function new_tournament(){
        return view('admin.new-tournament', ['users'=>User::where('is_admin',1)->get()]);
    }

    public function create_tournament(Request $request){
        if(empty($request->type) || empty($request->description) || empty($request->start_at_date) || empty($request->start_at_time) || empty($request->title) || empty($request->end_at_date) || empty($request->end_at_time) || empty($request->supervisor) || empty($request->max_participant)){
            return response()->json(["type" => "warning", "message" => "Please fill all fields."]);
        }

        $startAt = Carbon::parse($request->start_at_date . ' ' . $request->start_at_time);
        $endAt = Carbon::parse($request->end_at_date . ' ' . $request->end_at_time);

        // 1 - Bitiş zamanı başlama zamanından küçük olamaz
        if ($endAt <= $startAt) {
            return response()->json(["type" => "warning", "message" => "End time must be greater than start time."]);
        }

        // 2 - Başlama zamanı günümüzden geçmiş olamaz
        if ($startAt->isPast()) {
            return response()->json(["type" => "warning", "message" => "Start time cannot be in the past."]);
        }

        // 3 - Bitiş zamanı günümüzden geçmiş olamaz
        if ($endAt->isPast()) {
            return response()->json(["type" => "warning", "message" => "End time cannot be in the past."]);
        }

        $tournament = new Tournament();
        $tournament->title = $request->title;
        $tournament->description = $request->description;
        $tournament->start_at = $startAt;
        $tournament->end_at = $endAt;
        $tournament->supervisor = $request->supervisor;
        $tournament->max_participants = $request->max_participant;
        $tournament->type = $request->type;
        $tournament->cover = $request->cover;
        $tournament->round = $request->round;
        $tournament->status = 1;
        $tournament->created_by = Auth::user()->id;
        $tournament->is_published = 0;
        if($tournament->save()){
            return response()->json(["type" => "success", "message" => "Tournament created successfully.", "status" => true, 'tournament_id' => $tournament->id]);
        }else{
            return response()->json(["type" => "error", "message" => "Something went wrong.", "status" => false]);
        }
    }

    public function detail_tournament($id){
        $tournament = Tournament::find($id);
        return view('admin.detail-tournament', ['tournament' => $tournament, 'participants' => TournamentParticipant::where('tournament',$id)->where('status',1)->get(), 'matches' => TournamentMatches::where('tournament',$id)->get()]);
    }

    public function set_publish(Request $request){
        $t = Tournament::find($request->id);
        if($t->is_published !== $request->status){
            $t->is_published = $request->status;
            if($t->save()){
                return response()->json(["type" => "success", "message" => "Tournament publish status updated successfully.", "status" => true]);   
            }
        }
    }

    public function set_status(Request $request){
        $t = Tournament::find($request->id);
        if($t->status !== $request->status){
            $t->status = $request->status;
            if($t->save()){
                return response()->json(["type" => "success", "message" => "Tournament status updated successfully.", "status" => true]);   
            }
        }
    }

    public function remove(Request $request){
        $t = Tournament::find($request->id);
        if($t->delete()){
            return response()->json(["type" => "success", "message" => "Tournament removed successfully.", "status" => true]);   
        }
    }


    public function set_match(Request $request){
        $tournament = $request->tournament;
        $round = $request->round;
        $team1 = $request->team1;
        $team2 = $request->team2;

        if($team1 == 0){
            return response()->json(["type" => "warning", "message" => "Please, choose Team 1"]);
        }

        if($team2 == 0){
            return response()->json(["type" => "warning", "message" => "Please, choose Team 2"]);
        }

        if($team1 == $team2){
            return response()->json(["type" => "warning", "message" => "You have to choose different teams."]);
        }

        // Belirli turnuva ve tur için team1 veya team2 olarak belirtilen takımı içeren bir maç var mı kontrol et
        $existingMatch = TournamentMatches::where('tournament', $tournament)
        ->where('round', $round)
        ->where(function ($query) use ($team1, $team2) {
            $query->where('team1', $team1)
                ->orWhere('team2', $team1)
                ->orWhere('team1', $team2)
                ->orWhere('team2', $team2);
        })
        ->first();

        if($existingMatch){
            return response()->json(["type" => "warning", "message" => "A match with these teams already exists for this round."]);
        }

        $match = new TournamentMatches;
        $match->tournament = $tournament;
        $match->round = $round;
        $match->team1 = $team1;
        $match->team2 = $team2;
        $match->winner = 0;
        $match->status = 1;

        if($match->save()){
            return response()->json(["type" => "success", "message" => "Macth is created", "status" => true]);
        }else{
            return response()->json(["type" => "warning", "message" => "System Error"]);
        }
    }

    public function set_match_time(Request $request){
        $tournament = $request->tournament;
        $round = $request->round;
        $match = $request->match;
        $date = $request->date;
        $time = $request->time;
        $dateTime = $date.' '.$time;

        if(empty($date) || empty($request->time)){
            return response()->json(["type" => "warning", "message" => "Set a date and time."]);
        }

        $matchTime = TournamentMatchTimes::where('tournament',$tournament)->where('round',$round)->where('match_id', $match)->first();

        if($matchTime){
            $set = $matchTime;
            $set->tournament = $tournament;
            $set->round = $round;
            $set->match_id = $match;
            $set->match_time = $dateTime;

            if($set->save()){
                return response()->json(["type" => "success", "message" => "Macth Time is updated", "status" => true]); 
            }else{
                return response()->json(["type" => "warning", "message" => "System Error"]);
            }

        }else{
            $set = new TournamentMatchTimes;
            $set->tournament = $tournament;
            $set->round = $round;
            $set->match_id = $match;
            $set->match_time = $dateTime;

            if($set->save()){
                return response()->json(["type" => "success", "message" => "Macth Time is created", "status" => true]); 
            }else{
                return response()->json(["type" => "warning", "message" => "System Error"]);
            }

        }
    }

    public function set_winner(Request $request){
        $match = $request->match;
        $winner = $request->winner;

        $m = TournamentMatches::find($match);
        if($m){
            $m->winner = $winner;
            $m->status = 2;
            if($m->save()){
                return response()->json(["type" => "success", "message" => "Winner determined
                ", "status" => true]); 
            }else{
                return response()->json(["type" => "warning", "message" => "System Error"]);
            }
        }else{
            return response()->json(["type" => "warning", "message" => "Match not found!"]);
        }
    }
}