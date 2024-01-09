<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['event_id',
    'user_first_name',
    'user_last_name',
    'user_email',
    'user_phone_number',
    'is_accepted'];

    // Relation avec Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Si vous avez un modèle User, ajoutez également une relation avec celui-ci
    public function user()
    {
        return $this->belongsTo(User::class); // Assurez-vous que le modèle User existe
    }

    // Autres méthodes spécifiques aux inscriptions peuvent être ajoutées ici
}
