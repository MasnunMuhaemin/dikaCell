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
            'shipment_date' => Carbon::now()->addDays(1),
            'alamat_lengkap' => 'Jl. Kenanga No. 12',
            'kota' => 'Jakarta',
            'kecamatan' => 'Cempaka Putih',
            'desa' => 'Rawasari',
            'kode_pos' => '10570',
        ]);
        Shipment::create([
            'shipment_date' => Carbon::now()->addDays(2),
            'alamat_lengkap' => 'Jl. Melati No. 9',
            'kota' => 'Bandung',
            'kecamatan' => 'Coblong',
            'desa' => 'Dago',
            'kode_pos' => '40135',
        ]);
        Shipment::create([
            'shipment_date' => Carbon::now()->addDays(3),
            'alamat_lengkap' => 'Jl. Anggrek No. 5',
            'kota' => 'Surabaya',
            'kecamatan' => 'Sukolilo',
            'desa' => 'Keputih',
            'kode_pos' => '60111',
        ]);
    }
}
