<?php

namespace Epush\Auth\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\Infra\Database\Model\User;
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
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '01126999840',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'religion' => 'muslim',
            'contact_name' => 'ahmed',
        ]);
    }
}

