<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor_id',
        'path',
    ];

   

    // Dans App\Models\Photo

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
