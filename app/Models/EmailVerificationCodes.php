<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationCodes extends Model
{
    use HasFactory;

    protected $table = "email_verification_codes";
}
