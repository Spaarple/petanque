<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{

    protected $fillable = [
        'sponsor_name',
        'sponsor_logo',
        'sponsor_website',
        'sponsor_description',
        'sponsor_subscription_end_date',
        // Incluez tous les autres champs que vous souhaitez enregistrer
    ];


}