<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'kode_product' => '1234',
            'name' => 'Kampas rem',
            'description' => 'Kampas rem cakram motor berkualitas tinggi',
            'img' => 'aksesoris.png',
            'price' => 75000.00,
            'stock' => 20,
            'discount' => 20,
            'category_id' => 1, // asumsi ID 1 = Sparepart
        ]);
        Product::create([
            'kode_product' => '4321',
            'name' => 'Casing',
            'description' => 'Casing silikon pelindung untuk semua tipe HP',
            'img' => 'aksesoris.png',
            'price' => 25000.00,
            'discount' => 0,
            'stock' => 100,
            'category_id' => 2, // asumsi ID 2 = Aksesoris HP
        ]);
        Product::create([
            'kode_product' => '678',
            'name' => 'Obeng',
            'description' => 'Obeng set 31 in 1 multifungsi',
            'img' => 'aksesoris.png',
            'price' => 95000.00,
            'stock' => 50,
            'discount' => 10,
            'category_id' => 3, // asumsi ID 3 = Tools
        ]);
    }
}
