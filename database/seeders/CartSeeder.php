<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create([
            'user_id' => 1, // Pastikan user_id dan product_id valid
            'product_id' => 1,
            'quantity' => 2,
        ]);
        Cart::create([
            'user_id' => 2,
            'product_id' => 2,
            'quantity' => 1,
        ]);
        Cart::create([
            'user_id' => 1,
            'product_id' => 3,
            'quantity' => 5,
        ]);
    }
}
