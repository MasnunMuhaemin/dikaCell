<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Satu',
            'email' => 'admin@gmail.com',
            'alamat' => 'Jl. Merdeka No.1',
            'no_hp' => '081234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Customer Satu',
            'email' => 'customer@gmail.com',
            'alamat' => 'Jl. Sudirman No.2',
            'no_hp' => '082345678901',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
