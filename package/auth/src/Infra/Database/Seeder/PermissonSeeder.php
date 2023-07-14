<?php

namespace Epush\Auth\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\Infra\Database\Model\Permission;
use Illuminate\Database\Seeder;

class PermissonSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'signin',
            'handler_id' => '1'
        ]);

        Permission::create([
            'name' => 'signup',
            'handler_id' => '2'
        ]);

        Permission::create([
            'name' => 'reset-password',
            'handler_id' => '3'
        ]);

        Permission::create([
            'name' => 'generate-password',
            'handler_id' => '4'
        ]);


        Permission::create([
            'name' => 'list-app-services',
            'handler_id' => '5'
        ]);

        Permission::create([
            'name' => 'get-app-service-contexts',
            'handler_id' => '6'
        ]);

        Permission::create([
            'name' => 'update-app-service',
            'handler_id' => '7'
        ]);

        Permission::create([
            'name' => 'get-context-handle-groups',
            'handler_id' => '8'
        ]);

        Permission::create([
            'name' => 'update-context',
            'handler_id' => '9'
        ]);

        Permission::create([
            'name' => 'get-handle-group-handlers',
            'handler_id' => '10'
        ]);

        Permission::create([
            'name' => 'update-handle-group',
            'handler_id' => '11'
        ]);

        Permission::create([
            'name' => 'update-handler',
            'handler_id' => '12'
        ]);

        Permission::create([
            'name' => 'export-excel',
            'handler_id' => '13'
        ]);

        Permission::create([
            'name' => 'export-pdf',
            'handler_id' => '14'
        ]);
    }
}

