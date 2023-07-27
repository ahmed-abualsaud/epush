<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Orchi\Infra\Database\Model\Handler;
use Illuminate\Database\Seeder;

class HandlerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signin',
            'endpoint' => 'POST|http://localhost:8000/api/auth/signin',
            'description' => 'signin function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signup',
            'endpoint' => 'POST|http://localhost:8000/api/auth/signup',
            'description' => 'signup function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'resetPassword',
            'endpoint' => 'POST|http://localhost:8000/api/auth/reset-password',
            'description' => 'reset password function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'generatePassword',
            'endpoint' => 'POST|http://localhost:8000/api/auth/generate-password',
            'description' => 'generate password function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'listAppServices',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/service',
            'description' => 'list app services function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'getAppServiceContexts',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/service/{service_id}/contexts',
            'description' => 'get app service contexts function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'updateAppService',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/service/{service_id}',
            'description' => 'update app service function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'getContextHandleGroups',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/context/{context_id}/handle-groups',
            'description' => 'get context handle groups function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'updateContext',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/context/{context_id}',
            'description' => 'update context function',
            'enabled' => true,
        ]);


        Handler::create([
            'handle_group_id' => 4,
            'name' => 'getHandleGroupHandlers',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/handle-group/{handle_group_id}/handlers',
            'description' => 'get handle group handles function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'updateHandleGroup',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/handle-group/{handle_group_id}',
            'description' => 'update handle group function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 5,
            'name' => 'updateHandler',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/handler/{handler_id}',
            'description' => 'update handler function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 6,
            'name' => 'exportPDF',
            'endpoint' => 'POST|http://localhost:8000/api/file/export/pdf',
            'description' => 'export pdf file function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 6,
            'name' => 'exportExcel',
            'endpoint' => 'POST|http://localhost:8000/api/file/export/excel',
            'description' => 'export excel file function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getAllUserPermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}/all-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signout',
            'endpoint' => 'POST|http://localhost:8000/api/auth/signout',
            'description' => 'log out the current authenticated user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'listUsers',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user',
            'description' => 'get all users',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'listRoles',
            'endpoint' => 'GET|http://localhost:8000/api/auth/role',
            'description' => 'get all roles',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'listPermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/permission',
            'description' => 'get all permissions',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserRules',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}/roles',
            'description' => 'get the roles for a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getRolePermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'get permissions for a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserPermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'get permissions for a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'updateUser',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/user/{user_id}',
            'description' => 'update user data',
            'enabled' => true,
        ]);


        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserRoles',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/user/{user_id}/roles',
            'description' => 'unassign a group of roles to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserPermissions',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'deleteUser',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/user/{user_id}',
            'description' => 'delete a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserRoles',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/{user_id}/roles',
            'description' => 'assign a group of roles to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserPermissions',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'assign a group of permissions to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'updateRole',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/role/{role_id}',
            'description' => 'update a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'deleteRole',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/role/{role_id}',
            'description' => 'delete a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'updatePermission',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/permission/{permission_id}',
            'description' => 'update a specific permission',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'deletePermission',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/permission/{permission_id}',
            'description' => 'delete a specific permission',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'addRole',
            'endpoint' => 'POST|http://localhost:8000/api/auth/role',
            'description' => 'add new role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignRolePermissions',
            'endpoint' => 'POST|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'assign a group of permissions to a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignRolePermissions',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'enabled' => true,
        ]);
    }
}

