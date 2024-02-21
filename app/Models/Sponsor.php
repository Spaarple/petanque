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
        'sponsor_contact_email',
        'sponsor_contact_phone',
        'sponsor_contact_address',
        // Incluez tous les autres champs que vous souhaitez enregistrer
    ];

     // Dans App\Models\Sponsor

     public function photos()
     {
         return $this->hasMany(Photo::class);
     }

    
}
