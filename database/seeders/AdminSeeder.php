<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'password' => Hash::make('admin12345'), // Ganti dengan password yang aman
            'role' => 'admin',
        ]);
    }
}
