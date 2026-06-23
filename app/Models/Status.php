<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $fillable = [
        'payment_id',
        'status',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Pay::class, 'payment_id');
    }
}
