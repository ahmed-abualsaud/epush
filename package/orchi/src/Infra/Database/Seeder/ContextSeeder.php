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

        Context::create([
            'service_id' => 4,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 5,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 6,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 7,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 8,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 9,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 10,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);

        Context::create([
            'service_id' => 11,
            'name' => 'http',
            'online' => true,
            'enabled' => true,
            'num_of_handle_groups' => 1,
            'num_of_enabled_handle_groups' => 1
        ]);
    }
}

