<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'user_id','shipment_date', 'alamat_lengkap', 'kota', 'kecamatan', 'desa', 'kode_pos', 'shipping_cost', 'shipping_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
