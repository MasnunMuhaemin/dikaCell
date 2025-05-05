<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'payment_date'    => Carbon::now()->subDay(),
            'payment_method'  => 'transfer',
            'amount'          => 150000.00,
            // 'user_id'         => 1,
            'order_id'        => 1,
            'payment_status'  => 'paid',
        ]);
        Payment::create([
            'payment_date'    => Carbon::now()->subDay(),
            'payment_method'  => 'transfer',
            'amount'          => 150000.00,
            // 'user_id'         => 2,
            'order_id'        => 2,
            'payment_status'  => 'pending',
        ]);
        Payment::create([
            'payment_date'    => Carbon::now()->subDay(),
            'payment_method'  => 'transfer',
            'amount'          => 150000.00,
            // 'user_id'         => 1,
            'order_id'        => 1,
            'payment_status'  => 'pending',
        ]);
    }
}
