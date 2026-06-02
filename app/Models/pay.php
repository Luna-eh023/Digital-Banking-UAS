<?php

namespace App\Models;
//sementara gak tau pake database apa jadi mongodb dulu
use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'payments';

    protected $fillable = [
        'user_id',
        'amount',
        'status'
    ];
}