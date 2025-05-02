<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'customer']);

        $adminUser = \App\Models\User::where('name', 'Admin Satu')->first();
        $customerUser = \App\Models\User::where('name', 'Customer Satu')->first();

        $adminUser->assignRole('admin');
        $customerUser->assignRole('customer');
    }
}
