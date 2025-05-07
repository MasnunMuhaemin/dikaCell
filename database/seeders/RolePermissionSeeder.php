<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        $manageAll = Permission::firstOrCreate(['name' => 'manage all']);
        $manageClass = Permission::firstOrCreate(['name' => 'manage class']);

        $adminUser = \App\Models\User::where('name', 'Admin Satu')->first();
        $customerUser = \App\Models\User::where('name', 'Customer Satu')->first();

        $adminUser->assignRole('admin');
        $customerUser->assignRole('customer');

        $adminRole->givePermissionTo($manageAll);
        $customerRole->givePermissionTo($manageClass);
    }
}
