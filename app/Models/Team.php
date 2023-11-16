<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    // Team modelinin TeamMembers modeli ile ilişkisi
    public function Members()
    {
        return $this->hasMany(TeamMember::class, 'team', 'id');
    }
}
