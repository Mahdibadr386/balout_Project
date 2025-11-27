<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'driver',
        'mobile',
        'message',
        'status_code',
        'response',
        'error',
    ];
}
