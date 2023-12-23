<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $appends = ['type_info', 'status_info', 'publish_info'];
    public function getTypeInfoAttribute()
    {
        $typeInfos = [
            1 => [
                "title" => "Single",
                "color" => "warning",
            ],
            2 => [
                "title" => "Double",
                "color" => "primary",
            ],
            3 => [
                "title" => "League",
                "color" => "success",
            ],
        ];

        return $typeInfos[$this->type] ?? null;
    }

    public function getStatusInfoAttribute(){
        $statusInfo = [
            0 => [
                "title" => "Cancelled",
                "color" => "danger",
            ],
            1 => [
                "title" => "Pending",
                "color" => "warning",
            ],
            2 => [
                "title" => "Active",
                "color" => "primary",
            ],
            3 => [
                "title" => "Completed",
                "color" => "success",
            ],
            4 => [
                "title" => "Finished",
                "color" => "secondary",
            ]
        ];

        return $statusInfo[$this->status] ?? null;
    }

    public function getPublishInfoAttribute()
{
    $publishInfo = [
        0 => [
            "title" => "unPublished",
            "color" => "danger",
        ],
        1 => [
            "title" => "Published",
            "color" => "success",
        ]
    ];

    return $publishInfo[$this->is_published] ?? null;
}


    public function Winner(){
        return $this->hasOne(Team::class, 'id', 'winner');
    }
}
