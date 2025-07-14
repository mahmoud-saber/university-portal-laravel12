<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::Create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => UserRole::Admin,
                'status' => 10,
            ]
        );
    }
}
