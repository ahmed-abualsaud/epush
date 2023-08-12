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
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/signin',
            'description' => 'signin function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signup',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/signup',
            'description' => 'signup function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'signout',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/signout',
            'description' => 'log out the current authenticated user',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'resetPassword',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/reset-password',
            'description' => 'reset password function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 1,
            'name' => 'generatePassword',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/generate-password',
            'description' => 'generate password function',
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
            'name' => 'getUser',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}',
            'description' => 'get a specific user',
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
            'name' => 'deleteUser',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/user/{user_id}',
            'description' => 'delete a specific user',
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
            'name' => 'assignUserRoles',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/{user_id}/roles',
            'description' => 'assign a group of roles to a specific user',
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
            'name' => 'getUserPermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'get permissions for a specific user',
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
            'name' => 'assignUserPermissions',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/{user_id}/permissions',
            'description' => 'assign a group of permissions to a specific user',
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
            'name' => 'searchUserColumn',
            'endpoint' => 'POST|http://localhost:8000/api/auth/user/search',
            'description' => 'find a specific value for a column of the users table',
            'enabled' => true,
        ]);

        // Role Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'listRoles',
            'endpoint' => 'GET|http://localhost:8000/api/auth/role',
            'description' => 'get all roles',
            'enabled' => true,
        ]);
    
        Handler::create([
            'handle_group_id' => 2,
            'name' => 'addRole',
            'endpoint' => 'POST|http://localhost:8000/api/auth/role',
            'description' => 'add new role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'updateRole',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/role/{role_id}',
            'description' => 'update a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'deleteRole',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/role/{role_id}',
            'description' => 'delete a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'getRolePermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'get permissions for a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'assignRolePermissions',
            'endpoint' => 'POST|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'assign a group of permissions to a specific role',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 2,
            'name' => 'unassignRolePermissions',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/role/{role_id}/permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'enabled' => true,
        ]);


        // Permission Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'listPermissions',
            'endpoint' => 'GET|http://localhost:8000/api/auth/permission',
            'description' => 'get all permissions',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'updatePermission',
            'endpoint' => 'PUT|http://localhost:8000/api/auth/permission/{permission_id}',
            'description' => 'update a specific permission',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 3,
            'name' => 'deletePermission',
            'endpoint' => 'DELETE|http://localhost:8000/api/auth/permission/{permission_id}',
            'description' => 'delete a specific permission',
            'enabled' => true,
        ]);


        // AppService Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'listAppServices',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/service',
            'description' => 'list app services function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'getAppServiceContexts',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/service/{service_id}/contexts',
            'description' => 'get app service contexts function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 4,
            'name' => 'updateAppService',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/service/{service_id}',
            'description' => 'update app service function',
            'enabled' => true,
        ]);


        // Context Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 5,
            'name' => 'getContextHandleGroups',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/context/{context_id}/handle-groups',
            'description' => 'get context handle groups function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 5,
            'name' => 'updateContext',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/context/{context_id}',
            'description' => 'update context function',
            'enabled' => true,
        ]);


        // HandleGroup Controller Handlers =================================================================================================================
       
        Handler::create([
            'handle_group_id' => 6,
            'name' => 'getHandleGroupHandlers',
            'endpoint' => 'GET|http://localhost:8000/api/orchi/handle-group/{handle_group_id}/handlers',
            'description' => 'get handle group handles function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 6,
            'name' => 'updateHandleGroup',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/handle-group/{handle_group_id}',
            'description' => 'update handle group function',
            'enabled' => true,
        ]);

        
        // Handler Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 7,
            'name' => 'updateHandler',
            'endpoint' => 'PUT|http://localhost:8000/api/orchi/handler/{handler_id}',
            'description' => 'update handler function',
            'enabled' => true,
        ]);


        // FileExport Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportPDF',
            'endpoint' => 'POST|http://localhost:8000/api/file/export/pdf',
            'description' => 'export pdf file function',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 8,
            'name' => 'exportExcel',
            'endpoint' => 'POST|http://localhost:8000/api/file/export/excel',
            'description' => 'export excel file function',
            'enabled' => true,
        ]);

        
        // Admin Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 9,
            'name' => 'getAdmin',
            'endpoint' => 'GET|http://localhost:8000/api/admin/{user_id}',
            'description' => 'get a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'addAdmin',
            'endpoint' => 'POST|http://localhost:8000/api/admin',
            'description' => 'add new admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'listAdmins',
            'endpoint' => 'GET|http://localhost:8000/api/admin',
            'description' => 'list all admins',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'deleteAdmin',
            'endpoint' => 'DELETE|http://localhost:8000/api/admin/{user_id}',
            'description' => 'delete a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'updateAdmin',
            'endpoint' => 'PUT|http://localhost:8000/api/admin/{user_id}',
            'description' => 'update a specific admin',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 9,
            'name' => 'searchAdminColumn',
            'endpoint' => 'POST|http://localhost:8000/api/admin/search',
            'description' => 'find a specific value for a column of the admins table',
            'enabled' => true,
        ]);

        
        // Client Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'getClient',
            'endpoint' => 'GET|http://localhost:8000/api/client/{user_id}',
            'description' => 'get a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'addClient',
            'endpoint' => 'POST|http://localhost:8000/api/client',
            'description' => 'add new client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'listClients',
            'endpoint' => 'GET|http://localhost:8000/api/client',
            'description' => 'list all clients',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'deleteClient',
            'endpoint' => 'DELETE|http://localhost:8000/api/client/{user_id}',
            'description' => 'delete a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'updateClient',
            'endpoint' => 'PUT|http://localhost:8000/api/client/{user_id}',
            'description' => 'update a specific client',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 10,
            'name' => 'searchClientColumn',
            'endpoint' => 'POST|http://localhost:8000/api/client/search',
            'description' => 'find a specific value for a column of the clients table',
            'enabled' => true,
        ]);

        
        
        // Pricelist Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'listPricelists',
            'endpoint' => 'GET|http://localhost:8000/api/pricelist',
            'description' => 'list all pricelists',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'addPricelist',
            'endpoint' => 'POST|http://localhost:8000/api/pricelist',
            'description' => 'add new pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'getPricelist',
            'endpoint' => 'GET|http://localhost:8000/api/pricelist/{pricelist_id}',
            'description' => 'get a specific pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'updatePricelist',
            'endpoint' => 'PUT|http://localhost:8000/api/pricelist/{pricelist_id}',
            'description' => 'update a specific pricelist',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 11,
            'name' => 'deletePricelist',
            'endpoint' => 'DELETE|http://localhost:8000/api/pricelist/{pricelist_id}',
            'description' => 'delete a specific pricelist',
            'enabled' => true,
        ]);

        
        
        // BusinessField Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 12,
            'name' => 'listBusinessFields',
            'endpoint' => 'GET|http://localhost:8000/api/business-field',
            'description' => 'list all business fields',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'addBusinessField',
            'endpoint' => 'POST|http://localhost:8000/api/business-field',
            'description' => 'add new business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'getBusinessField',
            'endpoint' => 'GET|http://localhost:8000/api/business-field/{business_field_id}',
            'description' => 'get a specific business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'updateBusinessField',
            'endpoint' => 'PUT|http://localhost:8000/api/business-field/{business_field_id}',
            'description' => 'update a specific business field',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 12,
            'name' => 'deleteBusinessField',
            'endpoint' => 'DELETE|http://localhost:8000/api/business-field/{business_field_id}',
            'description' => 'delete a specific business field',
            'enabled' => true,
        ]);


        // Sales Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 13,
            'name' => 'getSales',
            'endpoint' => 'GET|http://localhost:8000/api/sales/{user_id}',
            'description' => 'get a specific sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'addSales',
            'endpoint' => 'POST|http://localhost:8000/api/sales',
            'description' => 'add new sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'listSales',
            'endpoint' => 'GET|http://localhost:8000/api/sales',
            'description' => 'list all sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'deleteSales',
            'endpoint' => 'DELETE|http://localhost:8000/api/sales/{user_id}',
            'description' => 'delete a specific sales',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 13,
            'name' => 'updateSales',
            'endpoint' => 'PUT|http://localhost:8000/api/sales/{user_id}',
            'description' => 'update a specific sales',
            'enabled' => true,
        ]);


        // PaymentMethod Controller Handlers =================================================================================================================
        
        Handler::create([
            'handle_group_id' => 14,
            'name' => 'listPaymentMethods',
            'endpoint' => 'GET|http://localhost:8000/api/expense/payment-method',
            'description' => 'list all payment methods',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'addPaymentMethod',
            'endpoint' => 'POST|http://localhost:8000/api/expense/payment-method',
            'description' => 'add new payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'getPaymentMethod',
            'endpoint' => 'GET|http://localhost:8000/api/expense/payment-method/{payment_method_id}',
            'description' => 'get a specific payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'updatePaymentMethod',
            'endpoint' => 'PUT|http://localhost:8000/api/expense/payment-method/{payment_method_id}',
            'description' => 'update a specific payment method',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 14,
            'name' => 'deletePaymentMethod',
            'endpoint' => 'DELETE|http://localhost:8000/api/expense/payment-method/{payment_method_id}',
            'description' => 'delete a specific payment method',
            'enabled' => true,
        ]);
    }
}

