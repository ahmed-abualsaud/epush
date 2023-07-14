<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Orchi\Infra\Database\Model\HandleGroup;
use Illuminate\Database\Seeder;

class HandleGroupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        HandleGroup::create([
            'context_id' => 1,
            'name' => 'AuthController',
            'description' => 'Controller holds all authentication service endpoints',
            'enabled' => true,
            'num_of_handlers' => 4,
            'num_of_enabled_handlers' => 4
        ]);

        HandleGroup::create([
            'context_id' => 2,
            'name' => 'AppServiceController',
            'description' => 'Controller holds all app services endpoints',
            'enabled' => true,
            'num_of_handlers' => 3,
            'num_of_enabled_handlers' => 3
        ]);

        HandleGroup::create([
            'context_id' => 2,
            'name' => 'ContextController',
            'description' => 'Controller holds all service contexts endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);

        HandleGroup::create([
            'context_id' => 2,
            'name' => 'HandleGroupController',
            'description' => 'Controller holds all context handle groups endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);

        HandleGroup::create([
            'context_id' => 2,
            'name' => 'HandlerController',
            'description' => 'Controller holds all handle group handlers endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);

        HandleGroup::create([
            'context_id' => 3,
            'name' => 'FileExportController',
            'description' => 'Controller holds all file export endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);
    }
}

