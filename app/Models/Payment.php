<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'payment_date', 'payment_method', 'amount'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
