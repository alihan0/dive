<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $appends = ['type_info', 'status_info'];
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
}
