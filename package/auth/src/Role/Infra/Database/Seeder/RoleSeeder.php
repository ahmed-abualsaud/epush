<?php

namespace Epush\Auth\Role\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\Role\Infra\Database\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'accountant']);
    }
}

