<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    use HasFactory;

    //$table->id();
    // $table->string('image_path');
    // $table->string('caption')->nullable();
    // $table->integer('order')->default(0);
    // $table->timestamps();
    protected $fillable = ['image_path', 'caption'];

    public function getImagePathAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = str_replace('storage/', '', $value);
    }
}
