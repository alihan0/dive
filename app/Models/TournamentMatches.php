<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentMatches extends Model
{
    use HasFactory;

    protected $appends = ['type_info', 'status_info', 'publish_info'];
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

    public function Team1(){
        return $this->hasOne(Team::class, 'id', 'team1');
    }
    public function Team2(){
        return $this->hasOne(Team::class, 'id', 'team2');
    }

    public function Time(){
        return $this->belongsTo(TournamentMatchTimes::class, 'id');
    }
}
