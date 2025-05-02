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
            'description' => 'Kampas rem cakram motor berkualitas tinggi',
            'price' => 75000.00,
            'stock' => 20,
            'category_id' => 1, // asumsi ID 1 = Sparepart
        ]);
        Product::create([
            'description' => 'Casing silikon pelindung untuk semua tipe HP',
            'price' => 25000.00,
            'stock' => 100,
            'category_id' => 2, // asumsi ID 2 = Aksesoris HP
        ]);
        Product::create([
            'description' => 'Obeng set 31 in 1 multifungsi',
            'price' => 95000.00,
            'stock' => 50,
            'category_id' => 3, // asumsi ID 3 = Tools
        ]);
    }
}
