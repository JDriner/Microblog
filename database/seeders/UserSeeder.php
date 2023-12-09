<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a sample user
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'profile_picture' => 'default_profile_picture.jpg',
            'phone_no' => '1234567890',
            'password' => Hash::make('password'),
            'is_activated' => true,
            'email_verified_at' => now(),
        ]);
    }
}
