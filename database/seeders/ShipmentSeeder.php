<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipment::create([
            'user_id'         => 2,
            'order_id'        => 2,
            'shipment_date'   => Carbon::now(),
            'alamat_lengkap'  => 'Jl. Melati No. 123',
            'kota'            => 'Bandung',
            'kecamatan'       => 'Coblong',
            'desa'            => 'Dago',
            'kode_pos'        => '40135',
            'shipping_cost'   => 25000,
            'shipping_status' => 'dikirim',
        ]);
        Shipment::create([
            'user_id'         => 2,
            'order_id'        => 2,
            'shipment_date'   => Carbon::now(),
            'alamat_lengkap'  => 'Jl. Melati No. 123',
            'kota'            => 'Bandung',
            'kecamatan'       => 'Cicaheum',
            'desa'            => 'Bubat',
            'kode_pos'        => '40135',
            'shipping_cost'   => 25000,
            'shipping_status' => 'belum dikirim',
        ]);
        Shipment::create([
            'user_id'         => 1,
            'order_id'        => 1,
            'shipment_date'   => Carbon::now(),
            'alamat_lengkap'  => 'Jl. Melati No. 123',
            'kota'            => 'Bandung',
            'kecamatan'       => 'Coblong',
            'desa'            => 'Dago',
            'kode_pos'        => '40135',
            'shipping_cost'   => 25000,
            'shipping_status' => 'diterima',
        ]);
    }
}
