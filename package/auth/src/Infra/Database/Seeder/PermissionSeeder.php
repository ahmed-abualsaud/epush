<?php

namespace Epush\Auth\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\Infra\Database\Model\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'signin',
            'description' => 'user signin',
            'handler_id' => '1'
        ]);

        Permission::create([
            'name' => 'signup',
            'description' => 'user signup',
            'handler_id' => '2'
        ]);

        Permission::create([
            'name' => 'reset-password',
            'description' => 'reset user password',
            'handler_id' => '3'
        ]);

        Permission::create([
            'name' => 'generate-password',
            'description' => 'generate new password for a specific user',
            'handler_id' => '4'
        ]);


        Permission::create([
            'name' => 'list-app-services',
            'description' => 'list all application services',
            'handler_id' => '5'
        ]);

        Permission::create([
            'name' => 'get-app-service-contexts',
            'description' => 'get application service contexts',
            'handler_id' => '6'
        ]);

        Permission::create([
            'name' => 'update-app-service',
            'description' => 'update application service',
            'handler_id' => '7'
        ]);

        Permission::create([
            'name' => 'get-context-handle-groups',
            'description' => 'get context handle group',
            'handler_id' => '8'
        ]);

        Permission::create([
            'name' => 'update-context',
            'description' => 'update service context',
            'handler_id' => '9'
        ]);

        Permission::create([
            'name' => 'get-handle-group-handlers',
            'description' => 'get handlers of a specific handle group',
            'handler_id' => '10'
        ]);

        Permission::create([
            'name' => 'update-handle-group',
            'description' => 'update context handle group',
            'handler_id' => '11'
        ]);

        Permission::create([
            'name' => 'update-handler',
            'description' => 'update specific handler',
            'handler_id' => '12'
        ]);

        Permission::create([
            'name' => 'export-excel',
            'description' => 'export file to excel',
            'handler_id' => '13'
        ]);

        Permission::create([
            'name' => 'export-pdf',
            'description' => 'export file to pdf',
            'handler_id' => '14'
        ]);

        Permission::create([
            'name' => 'get-all-user-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'handler_id' => '15'
        ]);

        Permission::create([
            'name' => 'signout',
            'description' => 'user signout',
            'handler_id' => '16'
        ]);

        Permission::create([
            'name' => 'list-users',
            'description' => 'list all users',
            'handler_id' => '17'
        ]);

        Permission::create([
            'name' => 'list-roles',
            'description' => 'list all roles',
            'handler_id' => '18'
        ]);

        Permission::create([
            'name' => 'list-permissions',
            'description' => 'list all permissions',
            'handler_id' => '19'
        ]);

        Permission::create([
            'name' => 'get-user-roles',
            'description' => 'get roles of a specific users',
            'handler_id' => '20'
        ]);

        Permission::create([
            'name' => 'get-role-permissions',
            'description' => 'get permissions of a specific role',
            'handler_id' => '21'
        ]);

        Permission::create([
            'name' => 'get-user-permissions',
            'description' => 'get permissions of a specific user',
            'handler_id' => '22'
        ]);

        Permission::create([
            'name' => 'update-user',
            'description' => 'update user data',
            'handler_id' => '23'
        ]);

        Permission::create([
            'name' => 'unassign-user-roles',
            'description' => 'unassign a group of roles to a specific user',
            'handler_id' => '24'
        ]);

        Permission::create([
            'name' => 'unassign-user-permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'handler_id' => '25'
        ]);

        Permission::create([
            'name' => 'delete-user',
            'description' => 'delete a specific user',
            'handler_id' => '26'
        ]);

        Permission::create([
            'name' => 'assign-user-roles',
            'description' => 'assign a group of roles to a specific user',
            'handler_id' => '27'
        ]);

        Permission::create([
            'name' => 'assign-user-permissions',
            'description' => 'assign a group of permissions to a specific user',
            'handler_id' => '28'
        ]);

        Permission::create([
            'name' => 'update-role',
            'description' => 'update a specific role',
            'handler_id' => '29'
        ]);

        Permission::create([
            'name' => 'delete-role',
            'description' => 'delete a specific role',
            'handler_id' => '30'
        ]);

        Permission::create([
            'name' => 'update-permission',
            'description' => 'update a specific permission',
            'handler_id' => '31'
        ]);

        Permission::create([
            'name' => 'delete-permission',
            'description' => 'delete a specific permission',
            'handler_id' => '32'
        ]);

        Permission::create([
            'name' => 'add-role',
            'description' => 'add new role',
            'handler_id' => '33'
        ]);

        Permission::create([
            'name' => 'assign-role-permissions',
            'description' => 'assign a group of permissions to a specific role',
            'handler_id' => '34'
        ]);

        Permission::create([
            'name' => 'unassign-role-permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'handler_id' => '35'
        ]);
    }
}

