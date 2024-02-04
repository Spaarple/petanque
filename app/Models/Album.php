<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    // Mise à jour de la propriété $fillable
    protected $fillable = ['name', 'description'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function coverImage()
    {
        return $this->hasOne(Image::class)->oldest();
    }
}

