<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipationTournois extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournoi_id',
        'user_first_name',
        'user_last_name',
        'user_email',
        'user_phone_number',
        'is_accepted',
        // Incluez tous les autres champs que vous souhaitez enregistrer

    ];
}
