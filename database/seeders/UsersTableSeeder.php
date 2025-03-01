<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@test.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('al08je09'),
            ]);
        }
    }
}