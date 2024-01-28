<?php

// app/Models/TrafficSource.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficSource extends Model
{
    protected $fillable = ['referer', 'hits'];
}
