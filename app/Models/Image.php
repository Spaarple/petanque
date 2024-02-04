<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['album_id', 'file_path'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

}
