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

    public function getPublicSponsorLogoAttribute()
    {
        return '/storage/sponsors_logos/' . $this->public_filename; // Assuming `public_filename` is the attribute name
    }
}
