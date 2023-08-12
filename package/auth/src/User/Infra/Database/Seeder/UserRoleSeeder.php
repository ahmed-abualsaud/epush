<?php

namespace Epush\Auth\User\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\User\Infra\Database\Model\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}

