<?php

namespace App\Http\Controllers;

use App\Models\Team;
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

        // 4 - Başlama zamanı günümüzden en az 10 gün sonra olmalı
        $tenDaysLater = now()->addDays(10);
        if ($startAt->lessThan($tenDaysLater)) {
            return response()->json(["type" => "warning", "message" => "Start time must be at least 10 days later."]);
        }

        // 5 - Bitiş zamanı başlama zamanından en az 5 gün sonra olmalı
        $fiveDaysLater = $startAt->addDays(5);
        if ($endAt->lessThan($fiveDaysLater)) {
            return response()->json(["type" => "warning", "message" => "End time must be at least 5 days later than start time."]);
        }

        $tournament = new Tournament();
        $tournament->title = $request->title;
        $tournament->description = $request->description;
        $tournament->start_at = $startAt;
        $tournament->end_at = $endAt;
        $tournament->supervisor = $request->supervisor;
        $tournament->max_participants = $request->max_participant;
        $tournament->type = $request->type;
        $tournament->status = 1;
        $tournament->created_by = Auth::user()->id;
        $tournament->is_published = 0;
        if($tournament->save()){
            return response()->json(["type" => "success", "message" => "Tournament created successfully.", "status" => true, 'tournament_id' => $tournament->id]);
        }else{
            return response()->json(["type" => "error", "message" => "Something went wrong.", "status" => false]);
        }
    }
}