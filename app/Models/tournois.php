<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tournois extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournoi_name',
        'tournoi_description',
        'tournoi_location',
        'tournoi_registration_deadline',
        'tournoi_start_date',
        'tournoi_pre_inscription_fee',
        'tournoi_inscription_fee',
        'tournoi_max_participants',
        'tournoi_team_local',
        'tournoi_team_visitor',
    ];

}
