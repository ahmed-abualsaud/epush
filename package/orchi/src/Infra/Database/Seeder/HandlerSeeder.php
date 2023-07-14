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
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'get user assigned permissions',
            'enabled' => true,
        ]);
    }
}

