<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentMatches extends Model
{
    use HasFactory;

    protected $appends = ['winner_info', 'status_info'];
    public function getStatusInfoAttribute(){
        $statusInfo = [
            1 => [
                "title" => "Pending",
                "color" => "warning",
            ],
            2 => [
                "title" => "Completed",
                "color" => "success",
            ]
        ];

        return $statusInfo[$this->status] ?? null;
    }

    public function getWinnerInfoAttribute(){
        $statusInfo = [
            0 => [
                "title" => "Pending",
                "color" => "warning",
            ],
            1 => [
                "title" => "Team 1",
                "color" => "primary",
            ],
            2 => [
                "title" => "Team 2",
                "color" => "primary",
            ]
        ];

        return $statusInfo[$this->winner] ?? null;
    }

    public function Team1(){
        return $this->hasOne(Team::class, 'id', 'team1');
    }
    public function Team2(){
        return $this->hasOne(Team::class, 'id', 'team2');
    }

    public function Time(){
        return $this->belongsTo(TournamentMatchTimes::class, 'id');
    }

    public function MatchTime(){
        return $this->hasOne(TournamentMatchTimes::class, 'match_id', 'id');
    }

    public function UserResults(){
        return $this->hasMany(TournamentUserResult::class, 'match_id', 'id');
    }

    public function Tournament(){
        return $this->belongsTo(Tournament::class,'tournament', 'id');
    }
}
