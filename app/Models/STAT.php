<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Status extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'statuses';

    protected $fillable = [
        'payment_id',
        'status'
    ];
}