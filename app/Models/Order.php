<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'order_date',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'cart_id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }
}
