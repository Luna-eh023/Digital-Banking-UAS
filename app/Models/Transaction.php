<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transfer_id',
        'status',
        'transaction_date'
    ];

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
}