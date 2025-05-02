<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1, // pastikan user dengan ID 1 ada
            'order_date' => Carbon::now()->subDays(2),
            'total_price' => 150000.00,
        ]);
        Order::create([
            'user_id' => 2, // pastikan user dengan ID 2 ada
            'order_date' => Carbon::now()->subDay(),
            'total_price' => 225000.00,
        ]);
        Order::create([
            'user_id' => 1,
            'order_date' => Carbon::now(),
            'total_price' => 90000.00,
        ]);
    }
}
