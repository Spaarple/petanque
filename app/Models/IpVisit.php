<?php

// app/Models/IpVisit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpVisit extends Model
{
    protected $fillable = ['ip', 'date'];
}
