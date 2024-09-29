<?php

namespace Epush\Auth\User\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\User\Infra\Database\Model\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Mohamed',
            'username' => config('auth.super_admin_username'),
            'email' => 'admin@gmail.com',
            'phone' => '01126999840',
            'address' => 'Alexandria',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/1.webp',
        ]);

        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Abu Al Saud',
            'username' => 'client@epushagency.com',
            'email' => 'ahmed.m.abualsaud@gmail.com',
            'phone' => '01126999840',
            'address' => 'Alexandria',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://mdbcdn.b-cdn.net/img/new/avatars/1.webp',
        ]);
    }
}

