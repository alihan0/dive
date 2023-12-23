<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament',
        'round',
        'team',
        'status'
    ];

    public function Team(){
        return $this->hasOne(Team::class, 'id', 'team');
    }
}
