<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\TournamentMatches;
use App\Models\TournamentParticipant;
use App\Models\VerificationMeeting;
use App\Models\Tournament;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Http;
use GuzzleHttp\Client;
use App\Models\User;

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

        $userInTeam = TeamMember::where('user', $request->id)->where('status',1)->exists();

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

    public function leave_team(Request $request)
    {
        $team = Team::find($request->team);
        $members = TeamMember::where('team', $request->team)->get();

        if (!$team) {
            return response()->json(['type' => 'error', 'message' => 'The team does not exist']);
        }

        $team->status = 0;

        foreach ($members as $member) {
            $member->status = 0;
            $member->save();
        }

        if ($team->save()) {
            return response()->json(['type' => 'success', 'message' => 'The team has been left successfully', 'status' => true]);
        } else {
            return response()->json(['type' => 'error', 'message' => 'The team has not been left successfully']);
        }
    }



    public function discord_verification_v2(){
       return view('app.discord_verification_v2');
    }



    function discord_verification_confirmation(Request $request) {
    
        $apiEndpoint = 'https://discord.com/api/v10';
        $clientId = env('DISCORD_CLIENT_ID');
        $clientSecret = env('DISCORD_CLIENT_SCRET');
    
        // Yetkilendirme sonrası yönlendirme URI'sini belirle
        $redirectUri = 'http://127.0.0.1:8000/app/verification/v2/discord/confirmation';
    
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => $redirectUri,
        ];
    
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    
        $client = new Client();
    
        try {
            $response = $client->post("$apiEndpoint/oauth2/token", [
                'form_params' => $data,
                'headers' => $headers,
                'auth' => [$clientId, $clientSecret],
            ]);
    
            $responseData = json_decode($response->getBody(), true);
    
            $accessToken = $responseData["access_token"];
    
            // Discord API endpoint
            $apiEndpoint = 'https://discord.com/api/v10';
    
            // Guzzle HTTP client
            $client = new Client();
    
            try {
                // Kullanıcı bilgisi için istek yap
                $response = $client->get("$apiEndpoint/users/@me", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                    ],
                ]);
    
                // Yanıtı dizi olarak al
                $userData = json_decode($response->getBody(), true);
    
                // Kontrolleri yap
                if (isset($userData['id'])) {
                    // 1 - Bu kullanıcı benim sunucumun bir üyesi mi?
                     $isMemberOfYourServer = $this->checkIfUserIsMemberOfYourServer($accessToken, $userData['id']);
    
                    // 2 - Bu kullanıcı benim sunucumda "verified" rolüne sahip mi?
                     $hasVerifiedRole = $this->checkIfUserHasVerifiedRole($accessToken, $userData['id']);
    
                    // Sonuçları göster
                    /*
                    print_r("1 - Bu kullanıcı benim sunucumun bir üyesi mi? " . ($isMemberOfYourServer ? 'Evet' : 'Hayır') . "\n");
                    print_r("2 - Bu kullanıcı benim sunucumda 'verified' rolüne sahip mi? " . ($hasVerifiedRole ? 'Evet' : 'Hayır') . "\n");
                    */

                    if($isMemberOfYourServer && $hasVerifiedRole){
                        $user = User::find(Auth::user()->id);
                        $user->discord_verification = 1;
                        $user->gender_verification = 1;

                        if($user->save()){
                            return redirect('/app');
                        }else{
                            echo "Kullanıcı onaylama sırasında bir hata oluştu";
                        }
                    }

                } else {
                    echo 'Kullanıcı bilgileri alınamadı.' . "\n";
                }
    
            } catch (\Exception $e) {
                // Hata durumunda işlemler
                echo 'Hata yakalandı: ', $e->getMessage(), "\n";
            }
    
        } catch (\Exception $e) {
            // Hata durumunda işlemler
            echo 'Hata yakalandı: ', $e->getMessage(), "\n";
        }
    }
    
    private function checkIfUserIsMemberOfYourServer($accessToken, $userId) {
        $apiEndpoint = 'https://discord.com/api/v10';
    
        // Sunucu ID'si
        $serverId = env('DISCORD_GUILD_ID');
    
        $client = new Client();
    
        try {
            $response = $client->get("$apiEndpoint/guilds/$serverId/members/$userId", [
                'headers' => [
                    'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN'),
                ],
            ]);
    
            $memberData = json_decode($response->getBody(), true);
    
            // Kullanıcının sunucu üyesi olup olmadığını kontrol et
            return isset($memberData['user']['id']);
        } catch (\Exception $e) {
            // Hata durumunda işlemler
            echo 'Hata yakalandı: ', $e->getMessage(), "\n";
            return false;
        }
    }


    private function checkIfUserHasVerifiedRole($accessToken, $userId) {
        $apiEndpoint = 'https://discord.com/api/v10';

        // Sunucu ID'si
        $serverId = env('DISCORD_GUILD_ID');

        // Rol ID'si
        $roleId = env('DISCORD_ROLE_ID');

        $client = new Client();

        try {
            $response = $client->get("$apiEndpoint/guilds/$serverId/members/$userId", [
                'headers' => [
                    'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN'),
                ],
            ]);

            $memberData = json_decode($response->getBody(), true);

            // Kullanıcının belirli bir role sahip olup olmadığını kontrol et
            return in_array($roleId, $memberData['roles']);
        } catch (\Exception $e) {
            // Hata durumunda işlemler
            echo 'Hata yakalandı: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function tournaments(){
        return view('app.tournaments', ['tournaments' => Tournament::all()]);
    }

    public function tournament_detail($id){
        return view('app.tournament_detail', ['tournament' => Tournament::find($id), 'participants' => TournamentParticipant::where('round',1)->where('tournament',$id)->get(), 'matches' => TournamentMatches::where('tournament',$id)->get()]);
    }

    public function apply_tournament(Request $request){
        $id = $request->id; // tournament id
        $user = Auth::user();
        $team_id =  $user->Team->team;
        $members = TeamMember::where('team',$team_id)->where('status',1)->get();
       
        foreach ($members as $member) {
            if($member->user == $user->id){
                if( $member->role != 1  && $member->role != 2 && $member->role != 3){
                    return response()->json(["type" => "warning", "message" => "You are not authorized for this operation."]);
                }
            }
            if($member->User->email_verification != 1 || $member->User->discord_verification != 1 || $member->User->gender_verification != 1){
                return response()->json(["type" => "warning", "message" => "Some members have not been verified."]);
            }
        }

        $applies = TournamentParticipant::where('tournament', $id)->where('round',1)->where("team", $team_id)->get();

        if($applies){
            return response()->json(["type" => "warning", "message" => "You have already applied."]);
        }

        $apply = new TournamentParticipant;
        $apply->tournament = $id;
        $apply->round = 1;
        $apply->team = $team_id;
        $apply->status = 1;

        if($apply->save()){
            return response()->json(["type" => "success", "message" => "Your tournament registration has been received.", "status" => true]);
        }else{
            return response()->json(["type" => "warning", "message" => "Something went wrong..."]);
        }
    }

    public function matches(Request $request){

        $user = Auth::user();
        $team = $user->team;
        $matches = TournamentMatches::where('team1',$team->team)->orWhere('team2',$team->team)->orderBy('id','desc')->get();

        return view('app.matches', ['matches' => $matches]);
    }

    public function match($id){
        return view('app.match', ['match' => TournamentMatches::find($id)]);
    }
}
