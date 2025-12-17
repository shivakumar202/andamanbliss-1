<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admins
        $admin = Admin::updateOrCreate(['id' => 1], [
            'name' => 'Admin',
            'mobile' => '9876543210',
            'mobile_verified_at' => now(),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'username' => 'admin',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $manager = Admin::updateOrCreate(['id' => 2], [
            'name' => 'Manager',
            'mobile' => '9876543211',
            'mobile_verified_at' => now(),
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'username' => 'manager',
            'password' => bcrypt('12345678'),
        ]);
        $manager->assignRole('manager');

        $telecaller = Admin::updateOrCreate(['id' => 3], [
            'name' => 'Telecaller',
            'mobile' => '9876543212',
            'mobile_verified_at' => now(),
            'email' => 'telecaller@gmail.com',
            'email_verified_at' => now(),
            'username' => 'telecaller',
            'password' => bcrypt('12345678'),
        ]);
        $telecaller->assignRole('telecaller');

        $guide = Admin::updateOrCreate(['id' => 4], [
            'name' => 'Guide',
            'mobile' => '9876543213',
            'mobile_verified_at' => now(),
            'email' => 'guide@gmail.com',
            'email_verified_at' => now(),
            'username' => 'guide',
            'password' => bcrypt('12345678'),
        ]);
        $guide->assignRole('guide');

        $driver = Admin::updateOrCreate(['id' => 5], [
            'name' => 'Driver',
            'mobile' => '9876543214',
            'mobile_verified_at' => now(),
            'email' => 'driver@gmail.com',
            'email_verified_at' => now(),
            'username' => 'driver',
            'password' => bcrypt('12345678'),
        ]);
        $driver->assignRole('driver');
    }
}
