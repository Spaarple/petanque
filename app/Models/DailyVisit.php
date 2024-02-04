<?php

// app/Models/DailyVisit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyVisit extends Model
{
    protected $fillable = ['date', 'visits', 'unique_visitors'];
}
