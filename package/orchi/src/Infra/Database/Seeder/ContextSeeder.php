<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Orchi\Infra\Database\Model\Context;
use Illuminate\Database\Seeder;

class ContextSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Context::create([
            'service_id' => 1,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 2,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 4,
            'num_of_enabled_handle_groups' => 4
        ]);

        Context::create([
            'service_id' => 3,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);
    }
}

