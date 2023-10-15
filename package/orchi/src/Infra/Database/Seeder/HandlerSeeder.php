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

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signin',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signin',
            'description' => 'signin function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signup',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signup',
            'description' => 'signup function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signout',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/signout',
            'description' => 'log out the current authenticated user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'resetPassword',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/reset-password',
            'description' => 'reset password function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'generatePassword',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/generate-password',
            'description' => 'generate password function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'listUsers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user',
            'description' => 'get all users',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUser',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'get a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'updateUser',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'update user data',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'deleteUser',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/user/{user_id}',
            'description' => 'delete a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserRules',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'get the roles for a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserRoles',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'assign a group of roles to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserRoles',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/roles',
            'description' => 'unassign a group of roles to a specific user',
            'enabled' => true,
        ]);


        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getUserPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'get permissions for a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'getAllUserPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/all-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'assignUserPermissions',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'assign a group of permissions to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'unassignUserPermissions',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/user/{user_id}/permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'searchUserColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/user/search',
            'description' => 'find a specific value for a column of the users table',
            'enabled' => true,
        ]);

        // Role Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'listRoles',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/role',
            'description' => 'get all roles',
            'enabled' => true,
        ]);
    
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'addRole',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/role',
            'description' => 'add new role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'updateRole',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/role/{role_id}',
            'description' => 'update a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'deleteRole',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/role/{role_id}',
            'description' => 'delete a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'getRolePermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'get permissions for a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'assignRolePermissions',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'assign a group of permissions to a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'unassignRolePermissions',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/role/{role_id}/permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'enabled' => true,
        ]);


        // Permission Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'listPermissions',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/auth/permission',
            'description' => 'get all permissions',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'updatePermission',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/auth/permission/{permission_id}',
            'description' => 'update a specific permission',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'deletePermission',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/auth/permission/{permission_id}',
            'description' => 'delete a specific permission',
            'enabled' => true,
        ]);


        // AppService Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'listAppServices',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/service',
            'description' => 'list app services function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'getAppServiceContexts',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/service/{service_id}/contexts',
            'description' => 'get app service contexts function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'updateAppService',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/service/{service_id}',
            'description' => 'update app service function',
            'enabled' => true,
        ]);


        // Context Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 5,
            'name' => 'getContextHandleGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/context/{context_id}/handle-groups',
            'description' => 'get context handle groups function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 5,
            'name' => 'updateContext',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/context/{context_id}',
            'description' => 'update context function',
            'enabled' => true,
        ]);


        // HandleGroup Controller Handlers =================================================================================================================
       
        Handler::create([
            'handle_group_id' => 6,
            'name' => 'getHandleGroupHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/handle-group/{handle_group_id}/handlers',
            'description' => 'get handle group handles function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 6,
            'name' => 'updateHandleGroup',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/handle-group/{handle_group_id}',
            'description' => 'update handle group function',
            'enabled' => true,
        ]);

        
        // Handler Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 7,
            'name' => 'listHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/orchi/handler',
            'description' => 'get all application handlers',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 7,
            'name' => 'updateHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/orchi/handler/{handler_id}',
            'description' => 'update handler function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 7,
            'name' => 'searchHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/orchi/handler/search',
            'description' => 'find a specific value for a column of the handlers table',
            'enabled' => true,
        ]);


        // FileExport Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportPDF',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file/export/pdf',
            'description' => 'export pdf file function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportExcel',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/file/export/excel',
            'description' => 'export excel file function',
            'enabled' => true,
        ]);

        
        // Admin Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'getAdmin',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'get a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'addAdmin',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/admin',
            'description' => 'add new admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'listAdmins',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/admin',
            'description' => 'list all admins',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'deleteAdmin',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'delete a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'updateAdmin',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/admin/{user_id}',
            'description' => 'update a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'searchAdminColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/admin/search',
            'description' => 'find a specific value for a column of the admins table',
            'enabled' => true,
        ]);

        
        // Client Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'get a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'addClient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/client',
            'description' => 'add new client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'listClients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client',
            'description' => 'list all clients',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'deleteClient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'delete a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'updateClient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/client/{user_id}',
            'description' => 'update a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'searchClientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/client/search',
            'description' => 'find a specific value for a column of the clients table',
            'enabled' => true,
        ]);

        
        
        // Pricelist Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'listPricelists',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/pricelist',
            'description' => 'list all pricelists',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'addPricelist',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/pricelist',
            'description' => 'add new pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getPricelist',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'get a specific pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'updatePricelist',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'update a specific pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'deletePricelist',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/pricelist/{pricelist_id}',
            'description' => 'delete a specific pricelist',
            'enabled' => true,
        ]);

        
        
        // BusinessField Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'listBusinessFields',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/business-field',
            'description' => 'list all business fields',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'addBusinessField',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/business-field',
            'description' => 'add new business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'getBusinessField',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'get a specific business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'updateBusinessField',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'update a specific business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'deleteBusinessField',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/business-field/{business_field_id}',
            'description' => 'delete a specific business field',
            'enabled' => true,
        ]);


        // Sales Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'getSales',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'get a specific sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'addSales',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sales',
            'description' => 'add new sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'listSales',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sales',
            'description' => 'list all sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'deleteSales',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'delete a specific sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'updateSales',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sales/{user_id}',
            'description' => 'update a specific sales',
            'enabled' => true,
        ]);


        // Country Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'getCountry',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'get a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'addCountry',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/country',
            'description' => 'add new country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'listCountries',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/country',
            'description' => 'list all countries',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'deleteCountry',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'delete a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'updateCountry',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/country/{country_id}',
            'description' => 'update a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'searchCountryColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/country/search',
            'description' => 'find a specific value for a column of the countries table',
            'enabled' => true,
        ]);


        // SMSC Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'getSMSC',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'get a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'addSMSC',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc',
            'description' => 'add new smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'listSMSCs',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc',
            'description' => 'list all smscs',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'deleteSMSC',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'delete a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'updateSMSC',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/smsc/{smsc_id}',
            'description' => 'update a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'searchSMSCColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc/search',
            'description' => 'find a specific value for a column of the smscs table',
            'enabled' => true,
        ]);


        // Operator Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'getOperator',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'get a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'addOperator',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/operator',
            'description' => 'add new operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'listOperators',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/operator',
            'description' => 'list all operators',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'deleteOperator',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'delete a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'updateOperator',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/operator/{operator_id}',
            'description' => 'update a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'searchOperatorColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/operator/search',
            'description' => 'find a specific value for a column of the operators table',
            'enabled' => true,
        ]);


        // SMSC Binding Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'getSMSCBinding',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'get a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'addSMSCBinding',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc-binding',
            'description' => 'add new smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'listSMSCBindings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/smsc-binding',
            'description' => 'list all smsc bindings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'deleteSMSCBinding',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'delete a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'updateSMSCBinding',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/smsc-binding/{smsc_binding_id}',
            'description' => 'update a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'searchSMSCBindingColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/smsc-binding/search',
            'description' => 'find a specific value for a column of the smsc bindings table',
            'enabled' => true,
        ]);


        // Sender Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'getSender',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'get a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'addSender',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender',
            'description' => 'add new sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'listSenders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender',
            'description' => 'list all senders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'getClientSenders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/senders',
            'description' => 'get client senders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'deleteSender',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'delete a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'updateSender',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sender/{sender_id}',
            'description' => 'update a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'searchSenderColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender/search',
            'description' => 'find a specific value for a column of the senders table',
            'enabled' => true,
        ]);


        // Sender Connection Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'getSenderConnection',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'get a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'addSenderConnection',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender-connection',
            'description' => 'add new sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'listSendersConnections',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender-connection',
            'description' => 'list all senders connections',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'getSenderConnections',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sender/{sender_id}/connections',
            'description' => 'get sender connections',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'deleteSenderConnection',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'delete a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'updateSenderConnection',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sender-connection/{sender_connection_id}',
            'description' => 'update a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'searchSenderConnectionColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sender-connection/search',
            'description' => 'find a specific value for a column of the sender connections table',
            'enabled' => true,
        ]);


        // Message Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'getMessage',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'get a specific message',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'addMessage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message',
            'description' => 'add new message',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'bulkAddMessage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message/bulk-add',
            'description' => 'bulk add new message',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'listMessages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message',
            'description' => 'list all messages',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'deleteMessage',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'delete a specific message',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'updateMessage',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message/{message_id}',
            'description' => 'update a specific message',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'searchMessageColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message/search',
            'description' => 'find a specific value for a column of the messages table',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClientMessages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/messages',
            'description' => 'get a specific client\'s messages',
            'enabled' => true,
        ]);


        // Message Language Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'getMessageLanguage',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'get a specific message language',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'addMessageLanguage',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-language',
            'description' => 'add new message language',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'listMessageLanguages',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-language',
            'description' => 'list all message languages',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'deleteMessageLanguage',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'delete a specific message language',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'updateMessageLanguage',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-language/{message_language_id}',
            'description' => 'update a specific message language',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'searchMessageLanguageColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-language/search',
            'description' => 'find a specific value for a column of the message languages table',
            'enabled' => true,
        ]);


        // Message Segment Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'getMessageSegment',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'get a specific message segment',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'addMessageSegment',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-segment',
            'description' => 'add new message segment',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'listMessageSegments',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-segment',
            'description' => 'list all message segments',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'deleteMessageSegment',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'delete a specific message segment',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'updateMessageSegment',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-segment/{message_segment_id}',
            'description' => 'update a specific message segment',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 22,
            'name' => 'searchMessageSegmentColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-segment/search',
            'description' => 'find a specific value for a column of the message segments table',
            'enabled' => true,
        ]);



        // Message Recipient Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'getMessageRecipient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'get a specific message recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'addMessageRecipient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-recipient',
            'description' => 'add new message recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'listMessageRecipients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-recipient',
            'description' => 'list all message recipients',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'deleteMessageRecipient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'delete a specific message recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'updateMessageRecipient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-recipient/{message_recipient_id}',
            'description' => 'update a specific message recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 23,
            'name' => 'searchMessageRecipientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-recipient/search',
            'description' => 'find a specific value for a column of the message recipients table',
            'enabled' => true,
        ]);


        // Message Group Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'getMessageGroup',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'get a specific message group',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'addMessageGroup',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group',
            'description' => 'add new message group',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'listMessageGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group',
            'description' => 'list all message groups',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'deleteMessageGroup',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'delete a specific message group',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'updateMessageGroup',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-group/{message_group_id}',
            'description' => 'update a specific message group',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 24,
            'name' => 'searchMessageGroupColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group/search',
            'description' => 'find a specific value for a column of the message groups table',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClientMessageGroups',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/message-groups',
            'description' => 'get a specific client\'s message groups',
            'enabled' => true,
        ]);


        // Message Group Recipient Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'getMessageGroupRecipient',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'get a specific message group recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'addMessageGroupRecipient',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group-recipient',
            'description' => 'add new message group recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'listMessageGroupRecipients',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-group-recipient',
            'description' => 'list all message group recipients',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'deleteMessageGroupRecipient',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'delete a specific message group recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'updateMessageGroupRecipient',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-group-recipient/{message_group_recipient_id}',
            'description' => 'update a specific message group recipient',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 25,
            'name' => 'searchMessageGroupRecipientColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-group-recipient/search',
            'description' => 'find a specific value for a column of the message group recipients table',
            'enabled' => true,
        ]);


        // Message Filter Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'getMessageFilter',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'get a specific message filter',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'addMessageFilter',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-filter',
            'description' => 'add new message filter',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'listMessageFilters',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/message-filter',
            'description' => 'list all message filters',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'deleteMessageFilter',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'delete a specific message filter',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'updateMessageFilter',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/message-filter/{message_filter_id}',
            'description' => 'update a specific message filter',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 26,
            'name' => 'searchMessageFilterColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/message-filter/search',
            'description' => 'find a specific value for a column of the message filters table',
            'enabled' => true,
        ]);


        // PaymentMethod Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 27,
            'name' => 'listPaymentMethods',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/payment-method',
            'description' => 'list all payment methods',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 27,
            'name' => 'addPaymentMethod',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/payment-method',
            'description' => 'add new payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 27,
            'name' => 'getPaymentMethod',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'get a specific payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 27,
            'name' => 'updatePaymentMethod',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'update a specific payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 27,
            'name' => 'deletePaymentMethod',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/expense/payment-method/{payment_method_id}',
            'description' => 'delete a specific payment method',
            'enabled' => true,
        ]);


        // Order Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 28,
            'name' => 'listOrders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/order',
            'description' => 'list all orders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 28,
            'name' => 'addOrder',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/order',
            'description' => 'add new order',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 28,
            'name' => 'getOrder',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/expense/order/{user_id}',
            'description' => 'get a specific order',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 28,
            'name' => 'updateOrder',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/expense/order/{order_id}',
            'description' => 'update a specific order',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 28,
            'name' => 'searchOrderColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/expense/order/search',
            'description' => 'find a specific value for a column of the orders table',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClientOrders',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/orders',
            'description' => 'get a specific client\'s orders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClientLatestOrder',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/client/{user_id}/latest-order',
            'description' => 'get the latest created order of a specific client',
            'enabled' => true,
        ]);


        // MailTemplateController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 29,
            'name' => 'listMailTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/template',
            'description' => 'list all mail templates',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 29,
            'name' => 'addMailTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/template',
            'description' => 'add new mail template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 29,
            'name' => 'getMailTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'get a specific mail template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 29,
            'name' => 'updateMailTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'update a specific mail template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 29,
            'name' => 'deleteMailTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/mail/template/{mail_template_id}',
            'description' => 'delete a specific mail template',
            'enabled' => true,
        ]);


        // MailSendingHandlerController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'listMailSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/sending-handler',
            'description' => 'list all mail sending handlers',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'addMailSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/sending-handler',
            'description' => 'add new mail sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'getMailSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'get a specific mail sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'updateMailSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'update a specific mail sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'deleteMailSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/mail/sending-handler/{mail_sending_handler_id}',
            'description' => 'delete a specific mail sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 30,
            'name' => 'searchMailSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/mail/sending-handler/search',
            'description' => 'find a specific value for a column of the mail sending handlers table',
            'enabled' => true,
        ]);


        // SMSTemplateController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 31,
            'name' => 'listSMSTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/template',
            'description' => 'list all sms templates',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 31,
            'name' => 'addSMSTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/template',
            'description' => 'add new sms template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 31,
            'name' => 'getSMSTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'get a specific sms template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 31,
            'name' => 'updateSMSTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'update a specific sms template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 31,
            'name' => 'deleteSMSTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sms/template/{sms_template_id}',
            'description' => 'delete a specific sms template',
            'enabled' => true,
        ]);


        // SMSSendingHandlerController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'listSMSSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/sending-handler',
            'description' => 'list all sms sending handlers',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'addSMSSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/sending-handler',
            'description' => 'add new sms sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'getSMSSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'get a specific sms sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'updateSMSSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'update a specific sms sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'deleteSMSSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/sms/sending-handler/{sms_sending_handler_id}',
            'description' => 'delete a specific sms sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 32,
            'name' => 'searchSMSSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/sms/sending-handler/search',
            'description' => 'find a specific value for a column of the sms sending handlers table',
            'enabled' => true,
        ]);


        // NotificationTemplateController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 33,
            'name' => 'listNotificationTemplates',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/template',
            'description' => 'list all notification templates',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 33,
            'name' => 'addNotificationTemplate',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/template',
            'description' => 'add new notification template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 33,
            'name' => 'getNotificationTemplate',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'get a specific notification template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 33,
            'name' => 'updateNotificationTemplate',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'update a specific notification template',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 33,
            'name' => 'deleteNotificationTemplate',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/template/{notification_template_id}',
            'description' => 'delete a specific notification template',
            'enabled' => true,
        ]);


        // NotificationSendingHandlerController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'listNotificationSendingHandlers',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/sending-handler',
            'description' => 'list all notification sending handlers',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'addNotificationSendingHandler',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/sending-handler',
            'description' => 'add new notification sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'getNotificationSendingHandler',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'get a specific notification sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'updateNotificationSendingHandler',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'update a specific notification sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'deleteNotificationSendingHandler',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/sending-handler/{notification_sending_handler_id}',
            'description' => 'delete a specific notification sending handler',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 34,
            'name' => 'searchNotificationSendingHandlerColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/sending-handler/search',
            'description' => 'find a specific value for a column of the notification sending handlers table',
            'enabled' => true,
        ]);



        // UserNotificationController Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'listUserNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification',
            'description' => 'list all user notifications',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'addUserNotification',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification',
            'description' => 'add new user notification',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'getUserNotification',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'get a specific user notification',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'getUserNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/user-notifications/{user_id}',
            'description' => 'get notifications of a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'getUserUnreadNotifications',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/notification/user-unread-notifications/{user_id}',
            'description' => 'get unread notifications of a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'updateUserNotification',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'update a specific user notification',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'updateUserNotifications',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/notification/user-notifications/{user_id}',
            'description' => 'update notifications of a specific user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'deleteUserNotification',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/notification/{user_notification_id}',
            'description' => 'delete a specific user notification',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 35,
            'name' => 'searchUserNotificationColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/notification/search',
            'description' => 'find a specific value for a column of the user notifications table',
            'enabled' => true,
        ]);


        // Settings Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 36,
            'name' => 'listSettings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/settings',
            'description' => 'list all settings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 36,
            'name' => 'addSettings',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/settings',
            'description' => 'add new settings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 36,
            'name' => 'getSettings',
            'endpoint' => 'GET|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'get a specific settings',
            'enabled' => true,
        ]);


        Handler::create([
            'handle_group_id' => 36,
            'name' => 'deleteSettings',
            'endpoint' => 'DELETE|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'delete a specific settings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 36,
            'name' => 'updateSettings',
            'endpoint' => 'PUT|'.env('APP_FULL_URL').'/api/settings/{settings_id}',
            'description' => 'update a specific settings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 36,
            'name' => 'searchSettingsColumn',
            'endpoint' => 'POST|'.env('APP_FULL_URL').'/api/settings/search',
            'description' => 'find a specific value for a column of the settings table',
            'enabled' => true,
        ]);

    }
}

