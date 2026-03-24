<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_page extends Model
{
    protected $table = 'webpage';
    protected $fillable = [
        'slug',
        'name',
        'status',
        'created_by',
        'html',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
