<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 150000.00,
        ]);
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 50000.00,
        ]);
        OrderItem::create([
            'order_id' => 2,
            'product_id' => 3,
            'quantity' => 3,
            'price' => 120000.00,
        ]);
    }
}
