<?php

namespace App\Http\Controllers;

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
}
