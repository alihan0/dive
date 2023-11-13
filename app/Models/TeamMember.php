<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    // TeamMembers modelinin Team modeli ile ilişkisi
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

}
