<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'contact_sender_email',
        'contact_sender_object',
        'contact_sender_message',
        'is_archived',
    ];
}
