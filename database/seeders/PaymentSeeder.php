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
            'payment_date' => Carbon::now()->subDays(2),
            'payment_method' => 'Transfer Bank',
            'amount' => 150000.00,
            'user_id' => 1, // pastikan user ID 1 ada
        ]);
        Payment::create([
            'payment_date' => Carbon::now()->subDay(),
            'payment_method' => 'OVO',
            'amount' => 225000.00,
            'user_id' => 2,
        ]);
        Payment::create([
            'payment_date' => Carbon::now(),
            'payment_method' => 'Gopay',
            'amount' => 90000.00,
            'user_id' => 1,
        ]);
    }
}
