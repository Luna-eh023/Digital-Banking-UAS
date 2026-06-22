<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    protected $fillable = [
        'email',
        'otp_code',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];
}