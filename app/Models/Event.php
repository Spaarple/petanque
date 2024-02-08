<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type', 'event_date', 'max_participants', 'is_validated', 'user_id', 'registration_deadline', 'pre_registration_fee', 'registration_fee', 'location'];

    // Relation avec EventRegistration
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    // Vous pouvez ajouter ici d'autres méthodes utiles pour votre logique métier
}
