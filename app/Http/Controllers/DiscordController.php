<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    protected $token;
    protected $guild;
    protected $api_url;
    protected $role_id;

    public function __construct()
    {
        $this->token = env('DISCORD_BOT_TOKEN');
        $this->guild = env('DISCORD_GUILD_ID');
        $this->api_url = env('DISCORD_API_URL');
        $this->role_id = env('DISCORD_ROLE_ID');
    }

    public function guild(){
        $response = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => "Bot $this->token"])->get("$this->api_url/guilds/$this->guild");
        return $response->json();
    }
    public function guild_roles(){
        $response = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => "Bot $this->token"])->get("$this->api_url/guilds/$this->guild/roles");
        return $response->json();
    }

    public function role_control($username){
        $response = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => "Bot $this->token"])->get("$this->api_url/guilds/$this->guild/members/search?query=$username");
        $userData = $response->json();

        if (in_array($this->role_id, $userData[0]["roles"])) {
            return response()->json(["message" => "Verified Successfullty", "status" => true]);
        } else {
            return response()->json(["message" => "Verified Unsuccessfully", "status" => false]);
        }
    }

    public function check_role(Request $request){

        if(empty($request->username)){
            return response()->json(["type" => "warning" , "message" => "Please Type Your Username"]);
        }

        $username = $request->username;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        $response = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => "Bot $this->token"])->get("$this->api_url/guilds/$this->guild/members/search?query=$username");
        $userData = $response->json();

        if(!$userData){
            return response()->json(["type" => "warning", "message" => "Verified Unsuccessfully", "status" => false]);
        }

        if (in_array($this->role_id, $userData[0]["roles"])) {
            $user->username = $username;
            $user->discord_verification = 1;
            $user->gender_verification = 1;
            if($user->save()){
                return response()->json(["type" => "success", "message" => "Verified Successfullty", "status" => true]);
            }
        } else {
            return response()->json(["type" => "warning", "message" => "Verified Unsuccessfully", "status" => false]);
        }
    }
}
