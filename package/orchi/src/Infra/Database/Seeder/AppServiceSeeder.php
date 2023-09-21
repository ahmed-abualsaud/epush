<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Orchi\Infra\Database\Model\AppService;
use Illuminate\Database\Seeder;

class AppServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AppService::create([
            'name' => 'auth',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'Authentication and Authorization Service',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);

        AppService::create([
            'name' => 'orchi',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'App Orchistration Service',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);

        AppService::create([
            'name' => 'file',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'File Management Service',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);

        AppService::create([
            'name' => 'core',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'Service Contains All Core Business Features',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);

        AppService::create([
            'name' => 'expense',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'Service Contains All the Features of Expense Tracking and Mangement',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);

        AppService::create([
            'name' => 'mail',
            'domain' => 'localhost',
            'ip_address' => '127.0.0.1',
            'lookup_type' => 'module',
            'lookup_endpoint' => 'http://localhost',
            'description' => 'Service Contains All the Features of Mail Management',
            'online' => true,
            'enabled' => true,
            'num_of_contexts' => 1,
            'num_of_online_contexts' => 1,
            'num_of_enabled_contexts' => 1
        ]);
    }
}

