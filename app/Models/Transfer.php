<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'sender',
        'receiver',
        'amount',
        'description'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}