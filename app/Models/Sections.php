<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;

    protected $table = "sections";

    protected $fillable = [
        "page",
        "section",
        "title",
        "sub_title",
        "detail",
        "cover",
        "content",
        "button1_text",
        "button1_src",
        "button2_text",
        "button2_src",
        "status"
    ];
}
