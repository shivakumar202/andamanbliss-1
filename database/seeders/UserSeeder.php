<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $user = User::updateOrCreate(['id' => 1], [
            'name' => 'User',
            'mobile' => '9876543215',
            'mobile_verified_at' => now(),
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'username' => 'user',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('user');
    }
}
