<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, 
            RolePermissionSeeder::class, 
            CategorySeeder::class, 
            ProductSeeder::class, 
            CartSeeder::class, 
            OrderSeeder::class, 
            OrderItemSeeder::class, 
            PaymentSeeder::class, 
            ShipmentSeeder::class, 
            WishlistSeeder::class
        ]);
    }
}
