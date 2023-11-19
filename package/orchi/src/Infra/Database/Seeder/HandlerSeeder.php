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
        // User Controller Handlers =================================================================================================================
        // 1
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signin',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signin',
            'description' => 'signin function',
            'enabled' => true,
        ]);
        // 2
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signup',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signup',
            'description' => 'signup function',
            'enabled' => true,
        ]);
        // 3
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signout',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signout',
            'description' => 'log out the current authenticated user',
            'enabled' => true,
        ]);
        // 4
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'resetPassword',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/reset-password',
            'description' => 'reset password function',
            'enabled' => true,
        ]);
        // 5
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'generatePassword',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/generate-password',
            'description' => 'generate password function',
            'enabled' => true,
        ]);
        // 6
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'listUsers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user',
            'description' => 'get all users',
            'enabled' => true,
        ]);
        // 7
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUser',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'get a specific user',
            'enabled' => true,
        ]);
        // 8
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'updateUser',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'update user data',
            'enabled' => true,
        ]);
        // 9
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'deleteUser',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'delete a specific user',
            'enabled' => true,
        ]);
        // 10
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserRoles',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'get the roles for a specific user',
            'enabled' => true,
        ]);
        // 11
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserRoles',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'assign a group of roles to a specific user',
            'enabled' => true,
        ]);
        // 12
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserRoles',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'unassign a group of roles to a specific user',
            'enabled' => true,
        ]);
        // 13
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'get permissions for a specific user',
            'enabled' => true,
        ]);
        // 14
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getAllUserPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/all-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'enabled' => true,
        ]);
        // 15
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserPermissions',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'assign a group of permissions to a specific user',
            'enabled' => true,
        ]);
        // 16
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserPermissions',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'enabled' => true,
        ]);
        // 17
        Handler::create([
            'handle_group_id' => 1,
            'name' => 'searchUserColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/search',
            'description' => 'find a specific value for a column of the users table',
            'enabled' => true,
        ]);

        // Role Controller Handlers =================================================================================================================
        // 18
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'listRoles',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/role',
            'description' => 'get all roles',
            'enabled' => true,
        ]);
        // 19
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'addRole',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/role',
            'description' => 'add new role',
            'enabled' => true,
        ]);
        // 20
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'updateRole',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/role/{role_id}',
            'description' => 'update a specific role',
            'enabled' => true,
        ]);
        // 21
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'deleteRole',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/role/{role_id}',
            'description' => 'delete a specific role',
            'enabled' => true,
        ]);
        // 22
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'getRolePermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'get permissions for a specific role',
            'enabled' => true,
        ]);
        // 23
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'assignRolePermissions',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'assign a group of permissions to a specific role',
            'enabled' => true,
        ]);
        // 24
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'unassignRolePermissions',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'enabled' => true,
        ]);


        // Permission Controller Handlers =================================================================================================================
        // 25
        Handler::create([
            'handle_group_id' => 3,
            'name' => 'listPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/permission',
            'description' => 'get all permissions',
            'enabled' => true,
        ]);
        // 26
        Handler::create([
            'handle_group_id' => 3,
            'name' => 'updatePermission',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/permission/{permission_id}',
            'description' => 'update a specific permission',
            'enabled' => true,
        ]);
        // 27
        Handler::create([
            'handle_group_id' => 3,
            'name' => 'deletePermission',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/permission/{permission_id}',
            'description' => 'delete a specific permission',
            'enabled' => true,
        ]);


        // AppService Controller Handlers =================================================================================================================
        // 28
        Handler::create([
            'handle_group_id' => 4,
            'name' => 'listAppServices',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/service',
            'description' => 'list app services function',
            'enabled' => true,
        ]);
        // 29
        Handler::create([
            'handle_group_id' => 4,
            'name' => 'getAppServiceContexts',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/service/{service_id}/contexts',
            'description' => 'get app service contexts function',
            'enabled' => true,
        ]);
        // 30
        Handler::create([
            'handle_group_id' => 4,
            'name' => 'updateAppService',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/service/{service_id}',
            'description' => 'update app service function',
            'enabled' => true,
        ]);


        // Context Controller Handlers =================================================================================================================
        // 31
        Handler::create([
            'handle_group_id' => 5,
            'name' => 'getContextHandleGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/context/{context_id}/handle-groups',
            'description' => 'get context handle groups function',
            'enabled' => true,
        ]);
        // 32
        Handler::create([
            'handle_group_id' => 5,
            'name' => 'updateContext',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/context/{context_id}',
            'description' => 'update context function',
            'enabled' => true,
        ]);


        // HandleGroup Controller Handlers =================================================================================================================
        // 33
        Handler::create([
            'handle_group_id' => 6,
            'name' => 'getHandleGroupHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/handle-group/{handle_group_id}/handlers',
            'description' => 'get handle group handles function',
            'enabled' => true,
        ]);
        // 34
        Handler::create([
            'handle_group_id' => 6,
            'name' => 'updateHandleGroup',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/handle-group/{handle_group_id}',
            'description' => 'update handle group function',
            'enabled' => true,
        ]);

        
        // Handler Controller Handlers =================================================================================================================
        // 35
        Handler::create([
            'handle_group_id' => 7,
            'name' => 'listHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/handler',
            'description' => 'get all application handlers',
            'enabled' => true,
        ]);
        // 36
        Handler::create([
            'handle_group_id' => 7,
            'name' => 'updateHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/handler/{handler_id}',
            'description' => 'update handler function',
            'enabled' => true,
        ]);
        // 37
        Handler::create([
            'handle_group_id' => 7,
            'name' => 'searchHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/orchi/handler/search',
            'description' => 'find a specific value for a column of the handlers table',
            'enabled' => true,
        ]);


        // File Controller Handlers =================================================================================================================
        // 38
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'getFile',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/file/{file_id}',
            'description' => 'get a specific file',
            'enabled' => true,
        ]);
        // 39
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'addFile',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file',
            'description' => 'add new file',
            'enabled' => true,
        ]);
        // 40
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'listFiles',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/file',
            'description' => 'list all files',
            'enabled' => true,
        ]);
        // 41
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'deleteFile',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/file/{file_id}',
            'description' => 'delete a specific file',
            'enabled' => true,
        ]);
        // 42
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'updateFile',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/file/{file_id}',
            'description' => 'update a specific file',
            'enabled' => true,
        ]);
        // 43
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'searchFileColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file/search',
            'description' => 'find a specific value for a column of the files table',
            'enabled' => true,
        ]);
        // 44
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportPDF',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file/export/pdf',
            'description' => 'export pdf file function',
            'enabled' => true,
        ]);
        // 45
        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportExcel',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file/export/excel',
            'description' => 'export excel file function',
            'enabled' => true,
        ]);


        // Folder Controller Handlers =================================================================================================================
        // 46
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'getFolder',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/folder/{folder_id}',
            'description' => 'get a specific folder',
            'enabled' => true,
        ]);
        // 47
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'addFolder',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/folder',
            'description' => 'add new folder',
            'enabled' => true,
        ]);
        // 48
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'listFolders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/folder',
            'description' => 'list all folders',
            'enabled' => true,
        ]);
        // 49
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'deleteFolder',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/folder/{folder_id}',
            'description' => 'delete a specific folder',
            'enabled' => true,
        ]);
        // 50
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'updateFolder',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/folder/{folder_id}',
            'description' => 'update a specific folder',
            'enabled' => true,
        ]);
        // 51
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'searchFolderColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/folder/search',
            'description' => 'find a specific value for a column of the folders table',
            'enabled' => true,
        ]);

        
        // Admin Controller Handlers =================================================================================================================
        // 52
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getAdmin',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'get a specific admin',
            'enabled' => true,
        ]);
        // 53
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'addAdmin',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/admin',
            'description' => 'add new admin',
            'enabled' => true,
        ]);
        // 54
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'listAdmins',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/admin',
            'description' => 'list all admins',
            'enabled' => true,
        ]);
        // 55
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'deleteAdmin',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'delete a specific admin',
            'enabled' => true,
        ]);
        // 56
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'updateAdmin',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'update a specific admin',
            'enabled' => true,
        ]);
        // 57
        Handler::create([
            'handle_group_id' => 10,
            'name' => 'searchAdminColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/admin/search',
            'description' => 'find a specific value for a column of the admins table',
            'enabled' => true,
        ]);

        
        // Client Controller Handlers =================================================================================================================
        // 58
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'get a specific client',
            'enabled' => true,
        ]);
        // 59
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'addClient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/client',
            'description' => 'add new client',
            'enabled' => true,
        ]);
        // 60
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'listClients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client',
            'description' => 'list all clients',
            'enabled' => true,
        ]);
        // 61
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'deleteClient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'delete a specific client',
            'enabled' => true,
        ]);
        // 62
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'updateClient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'update a specific client',
            'enabled' => true,
        ]);
        // 63
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'searchClientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/client/search',
            'description' => 'find a specific value for a column of the clients table',
            'enabled' => true,
        ]);
        // 64
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClientSenders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/senders',
            'description' => 'get client senders',
            'enabled' => true,
        ]);
        // 65
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClientMessages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/messages',
            'description' => 'get a specific client\'s messages',
            'enabled' => true,
        ]);
        // 66
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClientMessageGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/message-groups',
            'description' => 'get a specific client\'s message groups',
            'enabled' => true,
        ]);
        // 67
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClientOrders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/orders',
            'description' => 'get a specific client\'s orders',
            'enabled' => true,
        ]);
        // 68
        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getClientLatestOrder',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/latest-order',
            'description' => 'get the latest created order of a specific client',
            'enabled' => true,
        ]);


        // Pricelist Controller Handlers =================================================================================================================
        // 69
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'listPricelists',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/pricelist',
            'description' => 'list all pricelists',
            'enabled' => true,
        ]);
        // 70
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'addPricelist',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/pricelist',
            'description' => 'add new pricelist',
            'enabled' => true,
        ]);
        // 71
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'getPricelist',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'get a specific pricelist',
            'enabled' => true,
        ]);
        // 72
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'updatePricelist',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'update a specific pricelist',
            'enabled' => true,
        ]);
        // 73
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'deletePricelist',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'delete a specific pricelist',
            'enabled' => true,
        ]);


        // BusinessField Controller Handlers =================================================================================================================
        // 74
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'listBusinessFields',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/business-field',
            'description' => 'list all business fields',
            'enabled' => true,
        ]);
        // 75
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'addBusinessField',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/business-field',
            'description' => 'add new business field',
            'enabled' => true,
        ]);
        // 76
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'getBusinessField',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'get a specific business field',
            'enabled' => true,
        ]);
        // 77
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'updateBusinessField',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'update a specific business field',
            'enabled' => true,
        ]);
        // 78
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'deleteBusinessField',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'delete a specific business field',
            'enabled' => true,
        ]);


        // Sales Controller Handlers =================================================================================================================
        // 79
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'getSales',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'get a specific sales',
            'enabled' => true,
        ]);
        // 80
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'addSales',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sales',
            'description' => 'add new sales',
            'enabled' => true,
        ]);
        // 81
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'listSales',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sales',
            'description' => 'list all sales',
            'enabled' => true,
        ]);
        // 82
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'deleteSales',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'delete a specific sales',
            'enabled' => true,
        ]);
        // 83
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'updateSales',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'update a specific sales',
            'enabled' => true,
        ]);


        // Country Controller Handlers =================================================================================================================
        // 84
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'getCountry',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'get a specific country',
            'enabled' => true,
        ]);
        // 85
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'addCountry',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/country',
            'description' => 'add new country',
            'enabled' => true,
        ]);
        // 86
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'listCountries',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/country',
            'description' => 'list all countries',
            'enabled' => true,
        ]);
        // 87
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'deleteCountry',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'delete a specific country',
            'enabled' => true,
        ]);
        // 88
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'updateCountry',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'update a specific country',
            'enabled' => true,
        ]);
        // 89
        Handler::create([
            'handle_group_id' => 15,
            'name' => 'searchCountryColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/country/search',
            'description' => 'find a specific value for a column of the countries table',
            'enabled' => true,
        ]);


        // SMSC Controller Handlers =================================================================================================================
        // 90
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'getSMSC',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'get a specific smsc',
            'enabled' => true,
        ]);
        // 91
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'addSMSC',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc',
            'description' => 'add new smsc',
            'enabled' => true,
        ]);
        // 92
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'listSMSCs',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc',
            'description' => 'list all smscs',
            'enabled' => true,
        ]);
        // 93
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'deleteSMSC',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'delete a specific smsc',
            'enabled' => true,
        ]);
        // 94
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'updateSMSC',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'update a specific smsc',
            'enabled' => true,
        ]);
        // 95
        Handler::create([
            'handle_group_id' => 16,
            'name' => 'searchSMSCColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc/search',
            'description' => 'find a specific value for a column of the smscs table',
            'enabled' => true,
        ]);


        // Operator Controller Handlers =================================================================================================================
        // 96
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'getOperator',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'get a specific operator',
            'enabled' => true,
        ]);
        // 97
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'addOperator',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/operator',
            'description' => 'add new operator',
            'enabled' => true,
        ]);
        // 98
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'listOperators',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/operator',
            'description' => 'list all operators',
            'enabled' => true,
        ]);
        // 99
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'deleteOperator',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'delete a specific operator',
            'enabled' => true,
        ]);
        // 100
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'updateOperator',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'update a specific operator',
            'enabled' => true,
        ]);
        // 101
        Handler::create([
            'handle_group_id' => 17,
            'name' => 'searchOperatorColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/operator/search',
            'description' => 'find a specific value for a column of the operators table',
            'enabled' => true,
        ]);


        // SMSC Binding Controller Handlers =================================================================================================================
        // 102
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'getSMSCBinding',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'get a specific smsc binding',
            'enabled' => true,
        ]);
        // 103
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'addSMSCBinding',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc-binding',
            'description' => 'add new smsc binding',
            'enabled' => true,
        ]);
        // 104
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'listSMSCBindings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc-binding',
            'description' => 'list all smsc bindings',
            'enabled' => true,
        ]);
        // 105
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'deleteSMSCBinding',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'delete a specific smsc binding',
            'enabled' => true,
        ]);
        // 106
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'updateSMSCBinding',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'update a specific smsc binding',
            'enabled' => true,
        ]);
        // 107
        Handler::create([
            'handle_group_id' => 18,
            'name' => 'searchSMSCBindingColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc-binding/search',
            'description' => 'find a specific value for a column of the smsc bindings table',
            'enabled' => true,
        ]);


        // Sender Controller Handlers =================================================================================================================
        // 108
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'getSender',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'get a specific sender',
            'enabled' => true,
        ]);
        // 109
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'addSender',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender',
            'description' => 'add new sender',
            'enabled' => true,
        ]);
        // 110
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'listSenders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender',
            'description' => 'list all senders',
            'enabled' => true,
        ]);
        // 111
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'deleteSender',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'delete a specific sender',
            'enabled' => true,
        ]);
        // 112
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'updateSender',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'update a specific sender',
            'enabled' => true,
        ]);
        // 113
        Handler::create([
            'handle_group_id' => 19,
            'name' => 'searchSenderColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender/search',
            'description' => 'find a specific value for a column of the senders table',
            'enabled' => true,
        ]);


        // Sender Connection Controller Handlers =================================================================================================================
        // 114
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'getSenderConnection',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'get a specific sender connection',
            'enabled' => true,
        ]);
        // 115
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'addSenderConnection',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender-connection',
            'description' => 'add new sender connection',
            'enabled' => true,
        ]);
        // 116
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'listSendersConnections',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender-connection',
            'description' => 'list all senders connections',
            'enabled' => true,
        ]);
        // 117
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'getSenderConnections',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender/{sender_id}/connections',
            'description' => 'get sender connections',
            'enabled' => true,
        ]);
        // 118
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'deleteSenderConnection',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'delete a specific sender connection',
            'enabled' => true,
        ]);
        // 119
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'updateSenderConnection',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'update a specific sender connection',
            'enabled' => true,
        ]);
        // 120
        Handler::create([
            'handle_group_id' => 20,
            'name' => 'searchSenderConnectionColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender-connection/search',
            'description' => 'find a specific value for a column of the sender connections table',
            'enabled' => true,
        ]);


        // Message Controller Handlers =================================================================================================================
        // 121
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'listMessages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message',
            'description' => 'list all messages',
            'enabled' => true,
        ]);
        // 122
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'addMessage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message',
            'description' => 'add new message',
            'enabled' => true,
        ]);
        // 123
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'bulkAddMessage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message/bulk-add',
            'description' => 'bulk add new message',
            'enabled' => true,
        ]);
        // 124
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'getMessage',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'get a specific message',
            'enabled' => true,
        ]);
        // 125
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'updateMessage',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'update a specific message',
            'enabled' => true,
        ]);
        // 126
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'deleteMessage',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'delete a specific message',
            'enabled' => true,
        ]);
        // 127
        Handler::create([
            'handle_group_id' => 21,
            'name' => 'searchMessageColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message/search',
            'description' => 'find a specific value for a column of the messages table',
            'enabled' => true,
        ]);


        // Message Language Controller Handlers =================================================================================================================
        // 128
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'listMessageLanguages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-language',
            'description' => 'list all message languages',
            'enabled' => true,
        ]);
        // 129
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'addMessageLanguage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-language',
            'description' => 'add new message language',
            'enabled' => true,
        ]);
        // 130
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'getMessageLanguage',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'get a specific message language',
            'enabled' => true,
        ]);
        // 131
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'updateMessageLanguage',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'update a specific message language',
            'enabled' => true,
        ]);
        // 132
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'deleteMessageLanguage',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'delete a specific message language',
            'enabled' => true,
        ]);
        // 133
        Handler::create([
            'handle_group_id' => 22,
            'name' => 'searchMessageLanguageColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-language/search',
            'description' => 'find a specific value for a column of the message languages table',
            'enabled' => true,
        ]);


        // Message Segment Controller Handlers =================================================================================================================
        // 134
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'listMessageSegments',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-segment',
            'description' => 'list all message segments',
            'enabled' => true,
        ]);
        // 135
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'addMessageSegment',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-segment',
            'description' => 'add new message segment',
            'enabled' => true,
        ]);
        // 136
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'getMessageSegment',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'get a specific message segment',
            'enabled' => true,
        ]);
        // 137
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'updateMessageSegment',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'update a specific message segment',
            'enabled' => true,
        ]);
        // 138
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'deleteMessageSegment',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'delete a specific message segment',
            'enabled' => true,
        ]);
        // 139
        Handler::create([
            'handle_group_id' => 23,
            'name' => 'searchMessageSegmentColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-segment/search',
            'description' => 'find a specific value for a column of the message segments table',
            'enabled' => true,
        ]);



        // Message Recipient Controller Handlers =================================================================================================================
        // 140
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'listMessageRecipients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-recipient',
            'description' => 'list all message recipients',
            'enabled' => true,
        ]);
        // 141
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'addMessageRecipient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-recipient',
            'description' => 'add new message recipient',
            'enabled' => true,
        ]);
        // 142
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'getMessageRecipient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'get a specific message recipient',
            'enabled' => true,
        ]);
        // 143
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'updateMessageRecipient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'update a specific message recipient',
            'enabled' => true,
        ]);
        // 144
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'deleteMessageRecipient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'delete a specific message recipient',
            'enabled' => true,
        ]);
        // 145
        Handler::create([
            'handle_group_id' => 24,
            'name' => 'searchMessageRecipientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-recipient/search',
            'description' => 'find a specific value for a column of the message recipients table',
            'enabled' => true,
        ]);


        // Message Group Controller Handlers =================================================================================================================
        // 146
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'listMessageGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group',
            'description' => 'list all message groups',
            'enabled' => true,
        ]);
        // 147
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'addMessageGroup',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group',
            'description' => 'add new message group',
            'enabled' => true,
        ]);
        // 148
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'getMessageGroup',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'get a specific message group',
            'enabled' => true,
        ]);
        // 149
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'updateMessageGroup',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'update a specific message group',
            'enabled' => true,
        ]);
        // 150
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'deleteMessageGroup',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'delete a specific message group',
            'enabled' => true,
        ]);
        // 151
        Handler::create([
            'handle_group_id' => 25,
            'name' => 'searchMessageGroupColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group/search',
            'description' => 'find a specific value for a column of the message groups table',
            'enabled' => true,
        ]);


        // Message Group Recipient Controller Handlers =================================================================================================================
        // 152
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'listMessageGroupRecipients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group-recipient',
            'description' => 'list all message group recipients',
            'enabled' => true,
        ]);
        // 153
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'addMessageGroupRecipient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group-recipient',
            'description' => 'add new message group recipient',
            'enabled' => true,
        ]);
        // 154
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'getMessageGroupRecipient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'get a specific message group recipient',
            'enabled' => true,
        ]);
        // 155
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'updateMessageGroupRecipient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'update a specific message group recipient',
            'enabled' => true,
        ]);
        // 156
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'deleteMessageGroupRecipient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'delete a specific message group recipient',
            'enabled' => true,
        ]);
        // 157
        Handler::create([
            'handle_group_id' => 26,
            'name' => 'searchMessageGroupRecipientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group-recipient/search',
            'description' => 'find a specific value for a column of the message group recipients table',
            'enabled' => true,
        ]);


        // Message Filter Controller Handlers =================================================================================================================
        // 158
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'listMessageFilters',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-filter',
            'description' => 'list all message filters',
            'enabled' => true,
        ]);
        // 159
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'addMessageFilter',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-filter',
            'description' => 'add new message filter',
            'enabled' => true,
        ]);
        // 160
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'getMessageFilter',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'get a specific message filter',
            'enabled' => true,
        ]);
        // 161
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'updateMessageFilter',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'update a specific message filter',
            'enabled' => true,
        ]);
        // 162
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'deleteMessageFilter',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'delete a specific message filter',
            'enabled' => true,
        ]);
        // 163
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'searchMessageFilterColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-filter/search',
            'description' => 'find a specific value for a column of the message filters table',
            'enabled' => true,
        ]);


        // PaymentMethod Controller Handlers =================================================================================================================
        // 164
        Handler::create([
            'handle_group_id' => 28,
            'name' => 'listPaymentMethods',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/payment-method',
            'description' => 'list all payment methods',
            'enabled' => true,
        ]);
        // 165
        Handler::create([
            'handle_group_id' => 28,
            'name' => 'addPaymentMethod',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/payment-method',
            'description' => 'add new payment method',
            'enabled' => true,
        ]);
        // 166
        Handler::create([
            'handle_group_id' => 28,
            'name' => 'getPaymentMethod',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'get a specific payment method',
            'enabled' => true,
        ]);
        // 167
        Handler::create([
            'handle_group_id' => 28,
            'name' => 'updatePaymentMethod',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'update a specific payment method',
            'enabled' => true,
        ]);
        // 168
        Handler::create([
            'handle_group_id' => 28,
            'name' => 'deletePaymentMethod',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'delete a specific payment method',
            'enabled' => true,
        ]);


        // Order Controller Handlers =================================================================================================================
        // 169
        Handler::create([
            'handle_group_id' => 29,
            'name' => 'listOrders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/order',
            'description' => 'list all orders',
            'enabled' => true,
        ]);
        // 170
        Handler::create([
            'handle_group_id' => 29,
            'name' => 'addOrder',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/order',
            'description' => 'add new order',
            'enabled' => true,
        ]);
        // 171
        Handler::create([
            'handle_group_id' => 29,
            'name' => 'getOrder',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/order/{user_id}',
            'description' => 'get a specific order',
            'enabled' => true,
        ]);
        // 172
        Handler::create([
            'handle_group_id' => 29,
            'name' => 'updateOrder',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/expense/order/{order_id}',
            'description' => 'update a specific order',
            'enabled' => true,
        ]);
        // 173
        Handler::create([
            'handle_group_id' => 29,
            'name' => 'searchOrderColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/order/search',
            'description' => 'find a specific value for a column of the orders table',
            'enabled' => true,
        ]);


        // MailTemplateController Handlers =================================================================================================================
        // 174
        Handler::create([
            'handle_group_id' => 30,
            'name' => 'listMailTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/template',
            'description' => 'list all mail templates',
            'enabled' => true,
        ]);
        // 175
        Handler::create([
            'handle_group_id' => 30,
            'name' => 'addMailTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/template',
            'description' => 'add new mail template',
            'enabled' => true,
        ]);
        // 176
        Handler::create([
            'handle_group_id' => 30,
            'name' => 'getMailTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'get a specific mail template',
            'enabled' => true,
        ]);
        // 177
        Handler::create([
            'handle_group_id' => 30,
            'name' => 'updateMailTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'update a specific mail template',
            'enabled' => true,
        ]);
        // 178
        Handler::create([
            'handle_group_id' => 30,
            'name' => 'deleteMailTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'delete a specific mail template',
            'enabled' => true,
        ]);


        // MailSendingHandlerController Handlers =================================================================================================================
        // 179
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'listMailSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/sending-handler',
            'description' => 'list all mail sending handlers',
            'enabled' => true,
        ]);
        // 180
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'addMailSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/sending-handler',
            'description' => 'add new mail sending handler',
            'enabled' => true,
        ]);
        // 181
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'getMailSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'get a specific mail sending handler',
            'enabled' => true,
        ]);
        // 182
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'updateMailSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'update a specific mail sending handler',
            'enabled' => true,
        ]);
        // 183
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'deleteMailSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'delete a specific mail sending handler',
            'enabled' => true,
        ]);
        // 184
        Handler::create([
            'handle_group_id' => 31,
            'name' => 'searchMailSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/sending-handler/search',
            'description' => 'find a specific value for a column of the mail sending handlers table',
            'enabled' => true,
        ]);


        // SMSTemplateController Handlers =================================================================================================================
        // 185
        Handler::create([
            'handle_group_id' => 32,
            'name' => 'listSMSTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/template',
            'description' => 'list all sms templates',
            'enabled' => true,
        ]);
        // 186
        Handler::create([
            'handle_group_id' => 32,
            'name' => 'addSMSTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/template',
            'description' => 'add new sms template',
            'enabled' => true,
        ]);
        // 187
        Handler::create([
            'handle_group_id' => 32,
            'name' => 'getSMSTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'get a specific sms template',
            'enabled' => true,
        ]);
        // 188
        Handler::create([
            'handle_group_id' => 32,
            'name' => 'updateSMSTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'update a specific sms template',
            'enabled' => true,
        ]);
        // 189
        Handler::create([
            'handle_group_id' => 32,
            'name' => 'deleteSMSTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'delete a specific sms template',
            'enabled' => true,
        ]);


        // SMSSendingHandlerController Handlers =================================================================================================================
        // 190
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'listSMSSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/sending-handler',
            'description' => 'list all sms sending handlers',
            'enabled' => true,
        ]);
        // 191
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'addSMSSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/sending-handler',
            'description' => 'add new sms sending handler',
            'enabled' => true,
        ]);
        // 192
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'getSMSSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'get a specific sms sending handler',
            'enabled' => true,
        ]);
        // 193
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'updateSMSSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'update a specific sms sending handler',
            'enabled' => true,
        ]);
        // 194
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'deleteSMSSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'delete a specific sms sending handler',
            'enabled' => true,
        ]);
        // 195
        Handler::create([
            'handle_group_id' => 33,
            'name' => 'searchSMSSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/sending-handler/search',
            'description' => 'find a specific value for a column of the sms sending handlers table',
            'enabled' => true,
        ]);


        // NotificationTemplateController Handlers =================================================================================================================
        // 196
        Handler::create([
            'handle_group_id' => 34,
            'name' => 'listNotificationTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/template',
            'description' => 'list all notification templates',
            'enabled' => true,
        ]);
        // 197
        Handler::create([
            'handle_group_id' => 34,
            'name' => 'addNotificationTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/template',
            'description' => 'add new notification template',
            'enabled' => true,
        ]);
        // 198
        Handler::create([
            'handle_group_id' => 34,
            'name' => 'getNotificationTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'get a specific notification template',
            'enabled' => true,
        ]);
        // 199
        Handler::create([
            'handle_group_id' => 34,
            'name' => 'updateNotificationTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'update a specific notification template',
            'enabled' => true,
        ]);
        // 200
        Handler::create([
            'handle_group_id' => 34,
            'name' => 'deleteNotificationTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'delete a specific notification template',
            'enabled' => true,
        ]);


        // NotificationSendingHandlerController Handlers =================================================================================================================
        // 201
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'listNotificationSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/sending-handler',
            'description' => 'list all notification sending handlers',
            'enabled' => true,
        ]);
        // 202
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'addNotificationSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/sending-handler',
            'description' => 'add new notification sending handler',
            'enabled' => true,
        ]);
        // 203
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'getNotificationSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'get a specific notification sending handler',
            'enabled' => true,
        ]);
        // 204
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'updateNotificationSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'update a specific notification sending handler',
            'enabled' => true,
        ]);
        // 205
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'deleteNotificationSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'delete a specific notification sending handler',
            'enabled' => true,
        ]);
        // 206
        Handler::create([
            'handle_group_id' => 35,
            'name' => 'searchNotificationSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/sending-handler/search',
            'description' => 'find a specific value for a column of the notification sending handlers table',
            'enabled' => true,
        ]);


        // UserNotificationController Handlers =================================================================================================================
        // 207
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'listUserNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification',
            'description' => 'list all user notifications',
            'enabled' => true,
        ]);
        // 208
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'addUserNotification',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification',
            'description' => 'add new user notification',
            'enabled' => true,
        ]);
        // 209
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'getUserNotification',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'get a specific user notification',
            'enabled' => true,
        ]);
        // 210
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'getUserNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/user-notifications/{user_id}',
            'description' => 'get notifications of a specific user',
            'enabled' => true,
        ]);
        // 211
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'getUserUnreadNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/user-unread-notifications/{user_id}',
            'description' => 'get unread notifications of a specific user',
            'enabled' => true,
        ]);
        // 212
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'updateUserNotification',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'update a specific user notification',
            'enabled' => true,
        ]);
        // 213
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'updateUserNotifications',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/user-notifications/{user_id}',
            'description' => 'update notifications of a specific user',
            'enabled' => true,
        ]);
        // 214
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'deleteUserNotification',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'delete a specific user notification',
            'enabled' => true,
        ]);
        // 215
        Handler::create([
            'handle_group_id' => 36,
            'name' => 'searchUserNotificationColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/search',
            'description' => 'find a specific value for a column of the user notifications table',
            'enabled' => true,
        ]);


        // Settings Controller Handlers =================================================================================================================
        // 216
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'listSettings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/settings',
            'description' => 'list all settings',
            'enabled' => true,
        ]);
        // 217
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'addSettings',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/settings',
            'description' => 'add new settings',
            'enabled' => true,
        ]);
        // 218
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'getSettings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'get a specific settings',
            'enabled' => true,
        ]);
        // 219
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'updateSettings',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'update a specific settings',
            'enabled' => true,
        ]);        // 220
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'deleteSettings',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'delete a specific settings',
            'enabled' => true,
        ]);
        // 221
        Handler::create([
            'handle_group_id' => 37,
            'name' => 'searchSettingsColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/settings/search',
            'description' => 'find a specific value for a column of the settings table',
            'enabled' => true,
        ]);


        // Search Controller Handlers =================================================================================================================
        // 222
        Handler::create([
            'handle_group_id' => 38,
            'name' => 'search',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/search',
            'description' => 'execute an encrepted mysql query to search in multiple cross-cutting databases tables',
            'enabled' => true,
        ]);


        // Ticket Controller Handlers =================================================================================================================
        // 223
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'getTicket',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/ticket/{ticket_id}',
            'description' => 'get a specific ticket',
            'enabled' => true,
        ]);
        // 224
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'addTicket',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/ticket',
            'description' => 'add new ticket',
            'enabled' => true,
        ]);
        // 225
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'listTickets',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/ticket',
            'description' => 'list all tickets',
            'enabled' => true,
        ]);
        // 226
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'deleteTicket',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/ticket/{ticket_id}',
            'description' => 'delete a specific ticket',
            'enabled' => true,
        ]);
        // 227
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'updateTicket',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/ticket/{ticket_id}',
            'description' => 'update a specific ticket',
            'enabled' => true,
        ]);
        // 228
        Handler::create([
            'handle_group_id' => 39,
            'name' => 'searchTicketColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/ticket/search',
            'description' => 'find a specific value for a column of the tickets table',
            'enabled' => true,
        ]);
    }
}

