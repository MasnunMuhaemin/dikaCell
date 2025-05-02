<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $primaryKey = 'shipment_id';

    protected $fillable = [
        'shipment_date', 'alamat_lengkap', 'kota', 'kecamatan', 'desa', 'kode_pos'
    ];
}
