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


        // Order Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'getOrder',
            'endpoint' => 'GET|http://localhost:8000/api/order/{user_id}',
            'description' => 'get a specific order',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'addOrder',
            'endpoint' => 'POST|http://localhost:8000/api/order',
            'description' => 'add new order',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'listOrders',
            'endpoint' => 'GET|http://localhost:8000/api/order',
            'description' => 'list all orders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'searchOrderColumn',
            'endpoint' => 'POST|http://localhost:8000/api/order/search',
            'description' => 'find a specific value for a column of the orders table',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 15,
            'name' => 'getClientOrders',
            'endpoint' => 'GET|http://localhost:8000/api/client/{client_id}/orders',
            'description' => 'get a specific client\'s orders',
            'enabled' => true,
        ]);


        // Country Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'getCountry',
            'endpoint' => 'GET|http://localhost:8000/api/country/{country_id}',
            'description' => 'get a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'addCountry',
            'endpoint' => 'POST|http://localhost:8000/api/country',
            'description' => 'add new country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'listCountries',
            'endpoint' => 'GET|http://localhost:8000/api/country',
            'description' => 'list all countries',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'deleteCountry',
            'endpoint' => 'DELETE|http://localhost:8000/api/country/{country_id}',
            'description' => 'delete a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'updateCountry',
            'endpoint' => 'PUT|http://localhost:8000/api/country/{country_id}',
            'description' => 'update a specific country',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 16,
            'name' => 'searchCountryColumn',
            'endpoint' => 'POST|http://localhost:8000/api/country/search',
            'description' => 'find a specific value for a column of the countries table',
            'enabled' => true,
        ]);


        // SMSC Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'getSMSC',
            'endpoint' => 'GET|http://localhost:8000/api/smsc/{smsc_id}',
            'description' => 'get a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'addSMSC',
            'endpoint' => 'POST|http://localhost:8000/api/smsc',
            'description' => 'add new smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'listSMSCs',
            'endpoint' => 'GET|http://localhost:8000/api/smsc',
            'description' => 'list all smscs',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'deleteSMSC',
            'endpoint' => 'DELETE|http://localhost:8000/api/smsc/{smsc_id}',
            'description' => 'delete a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'updateSMSC',
            'endpoint' => 'PUT|http://localhost:8000/api/smsc/{smsc_id}',
            'description' => 'update a specific smsc',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 17,
            'name' => 'searchSMSCColumn',
            'endpoint' => 'POST|http://localhost:8000/api/smsc/search',
            'description' => 'find a specific value for a column of the smscs table',
            'enabled' => true,
        ]);


        // Operator Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'getOperator',
            'endpoint' => 'GET|http://localhost:8000/api/operator/{operator_id}',
            'description' => 'get a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'addOperator',
            'endpoint' => 'POST|http://localhost:8000/api/operator',
            'description' => 'add new operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'listOperators',
            'endpoint' => 'GET|http://localhost:8000/api/operator',
            'description' => 'list all operators',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'deleteOperator',
            'endpoint' => 'DELETE|http://localhost:8000/api/operator/{operator_id}',
            'description' => 'delete a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'updateOperator',
            'endpoint' => 'PUT|http://localhost:8000/api/operator/{operator_id}',
            'description' => 'update a specific operator',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 18,
            'name' => 'searchOperatorColumn',
            'endpoint' => 'POST|http://localhost:8000/api/operator/search',
            'description' => 'find a specific value for a column of the operators table',
            'enabled' => true,
        ]);


        // SMSC Binding Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'getSMSCBinding',
            'endpoint' => 'GET|http://localhost:8000/api/smsc-binding/{smsc_binding_id}',
            'description' => 'get a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'addSMSCBinding',
            'endpoint' => 'POST|http://localhost:8000/api/smsc-binding',
            'description' => 'add new smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'listSMSCBindings',
            'endpoint' => 'GET|http://localhost:8000/api/smsc-binding',
            'description' => 'list all smsc bindings',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'deleteSMSCBinding',
            'endpoint' => 'DELETE|http://localhost:8000/api/smsc-binding/{smsc_binding_id}',
            'description' => 'delete a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'updateSMSCBinding',
            'endpoint' => 'PUT|http://localhost:8000/api/smsc-binding/{smsc_binding_id}',
            'description' => 'update a specific smsc binding',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 19,
            'name' => 'searchSMSCBindingColumn',
            'endpoint' => 'POST|http://localhost:8000/api/smsc-binding/search',
            'description' => 'find a specific value for a column of the smsc bindings table',
            'enabled' => true,
        ]);


        // Sender Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'getSender',
            'endpoint' => 'GET|http://localhost:8000/api/sender/{sender_id}',
            'description' => 'get a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'addSender',
            'endpoint' => 'POST|http://localhost:8000/api/sender',
            'description' => 'add new sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'listSenders',
            'endpoint' => 'GET|http://localhost:8000/api/sender',
            'description' => 'list all senders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'getClientSenders',
            'endpoint' => 'GET|http://localhost:8000/api/client/{user_id}/senders',
            'description' => 'get client senders',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'deleteSender',
            'endpoint' => 'DELETE|http://localhost:8000/api/sender/{sender_id}',
            'description' => 'delete a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'updateSender',
            'endpoint' => 'PUT|http://localhost:8000/api/sender/{sender_id}',
            'description' => 'update a specific sender',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 20,
            'name' => 'searchSenderColumn',
            'endpoint' => 'POST|http://localhost:8000/api/sender/search',
            'description' => 'find a specific value for a column of the senders table',
            'enabled' => true,
        ]);


        // Sender Connection Controller Handlers =================================================================================================================

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'getSenderConnection',
            'endpoint' => 'GET|http://localhost:8000/api/sender-connection/{sender_connection_id}',
            'description' => 'get a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'addSenderConnection',
            'endpoint' => 'POST|http://localhost:8000/api/sender-connection',
            'description' => 'add new sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'listSendersConnections',
            'endpoint' => 'GET|http://localhost:8000/api/sender-connection',
            'description' => 'list all senders connections',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'getSenderConnections',
            'endpoint' => 'GET|http://localhost:8000/api/sender/{sender_id}/connections',
            'description' => 'get sender connections',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'deleteSenderConnection',
            'endpoint' => 'DELETE|http://localhost:8000/api/sender-connection/{sender_connection_id}',
            'description' => 'delete a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'updateSenderConnection',
            'endpoint' => 'PUT|http://localhost:8000/api/sender-connection/{sender_connection_id}',
            'description' => 'update a specific sender connection',
            'enabled' => true,
        ]);

        Handler::create([
            'handle_group_id' => 21,
            'name' => 'searchSenderConnectionColumn',
            'endpoint' => 'POST|http://localhost:8000/api/sender-connection/search',
            'description' => 'find a specific value for a column of the sender connections table',
            'enabled' => true,
        ]);
    }
}

