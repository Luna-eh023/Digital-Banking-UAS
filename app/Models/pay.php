<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pay extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    public function statuses(): HasMany
    {
        return $this->hasMany(Status::class, 'payment_id');
    }
}
