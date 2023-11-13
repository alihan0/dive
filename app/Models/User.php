<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthdate',
        'gender',
        'username',
        'discord',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'owner', 'id');
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'user', 'id');
    }
}
