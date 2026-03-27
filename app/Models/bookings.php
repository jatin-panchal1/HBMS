<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    protected $table = 'booking';
    protected $fillable = [
        'name' ,
        'email',
        'Date_time',
        'status',
        'user_id',
        'id',
    ];
}
