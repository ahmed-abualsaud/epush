<?php

namespace Epush\Auth\Permission\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Auth\Permission\Infra\Database\Model\Permission;
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
            'name' => 'signout',
            'description' => 'user signout',
            'handler_id' => '3'
        ]);

        Permission::create([
            'name' => 'reset-password',
            'description' => 'reset user password',
            'handler_id' => '4'
        ]);

        Permission::create([
            'name' => 'generate-password',
            'description' => 'generate new password for a specific user',
            'handler_id' => '5'
        ]);

        Permission::create([
            'name' => 'list-users',
            'description' => 'list all users',
            'handler_id' => '6'
        ]);

        Permission::create([
            'name' => 'get-user',
            'description' => 'get a specific user',
            'handler_id' => '7'
        ]);

        Permission::create([
            'name' => 'update-user',
            'description' => 'update user data',
            'handler_id' => '8'
        ]);

        Permission::create([
            'name' => 'delete-user',
            'description' => 'delete a specific user',
            'handler_id' => '9'
        ]);

        Permission::create([
            'name' => 'get-user-roles',
            'description' => 'get roles of a specific users',
            'handler_id' => '10'
        ]);

        Permission::create([
            'name' => 'assign-user-roles',
            'description' => 'assign a group of roles to a specific user',
            'handler_id' => '11'
        ]);

        Permission::create([
            'name' => 'unassign-user-roles',
            'description' => 'unassign a group of roles to a specific user',
            'handler_id' => '12'
        ]);

        Permission::create([
            'name' => 'get-user-permissions',
            'description' => 'get permissions of a specific user',
            'handler_id' => '13'
        ]);

        Permission::create([
            'name' => 'get-all-user-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'handler_id' => '14'
        ]);


        Permission::create([
            'name' => 'assign-user-permissions',
            'description' => 'assign a group of permissions to a specific user',
            'handler_id' => '15'
        ]);

        Permission::create([
            'name' => 'unassign-user-permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'handler_id' => '16'
        ]);
    
        Permission::create([
            'name' => 'search-user-column',
            'description' => 'find a specific value for a column of the users table',
            'handler_id' => '17'
        ]);




        Permission::create([
            'name' => 'list-roles',
            'description' => 'list all roles',
            'handler_id' => '18'
        ]);

        Permission::create([
            'name' => 'add-role',
            'description' => 'add new role',
            'handler_id' => '19'
        ]);

        Permission::create([
            'name' => 'get-role-permissions',
            'description' => 'get permissions of a specific role',
            'handler_id' => '20'
        ]);

        Permission::create([
            'name' => 'update-role',
            'description' => 'update a specific role',
            'handler_id' => '21'
        ]);

        Permission::create([
            'name' => 'delete-role',
            'description' => 'delete a specific role',
            'handler_id' => '22'
        ]);

        Permission::create([
            'name' => 'assign-role-permissions',
            'description' => 'assign a group of permissions to a specific role',
            'handler_id' => '23'
        ]);

        Permission::create([
            'name' => 'unassign-role-permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'handler_id' => '24'
        ]);




        Permission::create([
            'name' => 'list-permissions',
            'description' => 'list all permissions',
            'handler_id' => '25'
        ]);

        Permission::create([
            'name' => 'update-permission',
            'description' => 'update a specific permission',
            'handler_id' => '26'
        ]);

        Permission::create([
            'name' => 'delete-permission',
            'description' => 'delete a specific permission',
            'handler_id' => '27'
        ]);




        Permission::create([
            'name' => 'list-app-services',
            'description' => 'list all application services',
            'handler_id' => '28'
        ]);

        Permission::create([
            'name' => 'get-app-service-contexts',
            'description' => 'get application service contexts',
            'handler_id' => '29'
        ]);

        Permission::create([
            'name' => 'update-app-service',
            'description' => 'update application service',
            'handler_id' => '30'
        ]);




        Permission::create([
            'name' => 'get-context-handle-groups',
            'description' => 'get context handle group',
            'handler_id' => '31'
        ]);

        Permission::create([
            'name' => 'update-context',
            'description' => 'update service context',
            'handler_id' => '32'
        ]);




        Permission::create([
            'name' => 'get-handle-group-handlers',
            'description' => 'get handlers of a specific handle group',
            'handler_id' => '33'
        ]);

        Permission::create([
            'name' => 'update-handle-group',
            'description' => 'update context handle group',
            'handler_id' => '34'
        ]);




        Permission::create([
            'name' => 'update-handler',
            'description' => 'update specific handler',
            'handler_id' => '35'
        ]);




        Permission::create([
            'name' => 'export-excel',
            'description' => 'export file to excel',
            'handler_id' => '36'
        ]);

        Permission::create([
            'name' => 'export-pdf',
            'description' => 'export file to pdf',
            'handler_id' => '37'
        ]);




        Permission::create([
            'name' => 'get-admin',
            'description' => 'get a specific admin',
            'handler_id' => '38'
        ]);

        Permission::create([
            'name' => 'add-admin',
            'description' => 'add new admin',
            'handler_id' => '39'
        ]);

        Permission::create([
            'name' => 'list-admins',
            'description' => 'list all admins',
            'handler_id' => '40'
        ]);

        Permission::create([
            'name' => 'delete-admin',
            'description' => 'delete a specific admin',
            'handler_id' => '41'
        ]);

        Permission::create([
            'name' => 'update-admin',
            'description' => 'update a specific admin',
            'handler_id' => '42'
        ]);

        Permission::create([
            'name' => 'search-admin-column',
            'description' => 'find a specific value for a column of the admins table',
            'handler_id' => '43'
        ]);




        Permission::create([
            'name' => 'get-client',
            'description' => 'get a specific client',
            'handler_id' => '44'
        ]);

        Permission::create([
            'name' => 'add-client',
            'description' => 'add new client',
            'handler_id' => '45'
        ]);

        Permission::create([
            'name' => 'list-clients',
            'description' => 'list all clients',
            'handler_id' => '46'
        ]);

        Permission::create([
            'name' => 'delete-client',
            'description' => 'delete a specific client',
            'handler_id' => '47'
        ]);

        Permission::create([
            'name' => 'update-client',
            'description' => 'update a specific client',
            'handler_id' => '48'
        ]);

        Permission::create([
            'name' => 'search-client-column',
            'description' => 'find a specific value for a column of the clients table',
            'handler_id' => '49'
        ]);




        Permission::create([
            'name' => 'list-pricelists',
            'description' => 'list all pricelists',
            'handler_id' => '50'
        ]);

        Permission::create([
            'name' => 'add-pricelist',
            'description' => 'add new pricelist',
            'handler_id' => '51'
        ]);

        Permission::create([
            'name' => 'get-pricelist',
            'description' => 'get a specific pricelist',
            'handler_id' => '52'
        ]);

        Permission::create([
            'name' => 'update-pricelist',
            'description' => 'update a specific pricelist',
            'handler_id' => '53'
        ]);

        Permission::create([
            'name' => 'delete-pricelist',
            'description' => 'delete a specific pricelist',
            'handler_id' => '54'
        ]);




        Permission::create([
            'name' => 'list-business-fields',
            'description' => 'list all business fields',
            'handler_id' => '55'
        ]);

        Permission::create([
            'name' => 'add-business-field',
            'description' => 'add new business field',
            'handler_id' => '56'
        ]);

        Permission::create([
            'name' => 'get-business-field',
            'description' => 'get a specific business field',
            'handler_id' => '57'
        ]);

        Permission::create([
            'name' => 'update-business-field',
            'description' => 'update a specific business field',
            'handler_id' => '58'
        ]);

        Permission::create([
            'name' => 'delete-business-field',
            'description' => 'delete a specific business field',
            'handler_id' => '59'
        ]);




        Permission::create([
            'name' => 'get-sales',
            'description' => 'get a specific sales',
            'handler_id' => '60'
        ]);

        Permission::create([
            'name' => 'add-sales',
            'description' => 'add new sales',
            'handler_id' => '61'
        ]);

        Permission::create([
            'name' => 'list-sales',
            'description' => 'list all sales',
            'handler_id' => '62'
        ]);

        Permission::create([
            'name' => 'delete-sales',
            'description' => 'delete a specific sales',
            'handler_id' => '63'
        ]);

        Permission::create([
            'name' => 'update-sales',
            'description' => 'update a specific sales',
            'handler_id' => '64'
        ]);




        Permission::create([
            'name' => 'list-payment-methods',
            'description' => 'list all payment methods',
            'handler_id' => '65'
        ]);

        Permission::create([
            'name' => 'add-payment-method',
            'description' => 'add new payment method',
            'handler_id' => '66'
        ]);

        Permission::create([
            'name' => 'get-payment-method',
            'description' => 'get a specific payment method',
            'handler_id' => '67'
        ]);

        Permission::create([
            'name' => 'update-payment-method',
            'description' => 'update a specific payment method',
            'handler_id' => '68'
        ]);

        Permission::create([
            'name' => 'delete-payment-method',
            'description' => 'delete a specific payment method',
            'handler_id' => '69'
        ]);




        Permission::create([
            'name' => 'get-order',
            'description' => 'get a specific order',
            'handler_id' => '70'
        ]);

        Permission::create([
            'name' => 'add-order',
            'description' => 'add new order',
            'handler_id' => '71'
        ]);

        Permission::create([
            'name' => 'list-orders',
            'description' => 'list all orders',
            'handler_id' => '72'
        ]);

        Permission::create([
            'name' => 'search-order-column',
            'description' => 'find a specific value for a column of the orders table',
            'handler_id' => '73'
        ]);

        Permission::create([
            'name' => 'get-client-orders',
            'description' => 'get a specific client\'s orders',
            'handler_id' => '74'
        ]);




        Permission::create([
            'name' => 'get-country',
            'description' => 'get a specific country',
            'handler_id' => '75'
        ]);

        Permission::create([
            'name' => 'add-country',
            'description' => 'add new country',
            'handler_id' => '76'
        ]);

        Permission::create([
            'name' => 'list-countries',
            'description' => 'list all countries',
            'handler_id' => '77'
        ]);

        Permission::create([
            'name' => 'delete-country',
            'description' => 'delete a specific country',
            'handler_id' => '78'
        ]);

        Permission::create([
            'name' => 'update-country',
            'description' => 'update a specific country',
            'handler_id' => '79'
        ]);

        Permission::create([
            'name' => 'search-country-column',
            'description' => 'find a specific value for a column of the countries table',
            'handler_id' => '80'
        ]);




        Permission::create([
            'name' => 'get-smsc',
            'description' => 'get a specific smsc',
            'handler_id' => '81'
        ]);

        Permission::create([
            'name' => 'add-smsc',
            'description' => 'add new smsc',
            'handler_id' => '82'
        ]);

        Permission::create([
            'name' => 'list-smscs',
            'description' => 'list all smscs',
            'handler_id' => '83'
        ]);

        Permission::create([
            'name' => 'delete-smsc',
            'description' => 'delete a specific smsc',
            'handler_id' => '84'
        ]);

        Permission::create([
            'name' => 'update-smsc',
            'description' => 'update a specific smsc',
            'handler_id' => '85'
        ]);

        Permission::create([
            'name' => 'search-smsc-column',
            'description' => 'find a specific value for a column of the smscs table',
            'handler_id' => '86'
        ]);




        Permission::create([
            'name' => 'get-operator',
            'description' => 'get a specific operator',
            'handler_id' => '87'
        ]);

        Permission::create([
            'name' => 'add-operator',
            'description' => 'add new operator',
            'handler_id' => '88'
        ]);

        Permission::create([
            'name' => 'list-operators',
            'description' => 'list all operators',
            'handler_id' => '89'
        ]);

        Permission::create([
            'name' => 'delete-operator',
            'description' => 'delete a specific operator',
            'handler_id' => '90'
        ]);

        Permission::create([
            'name' => 'update-operator',
            'description' => 'update a specific operator',
            'handler_id' => '91'
        ]);

        Permission::create([
            'name' => 'search-operator-column',
            'description' => 'find a specific value for a column of the operators table',
            'handler_id' => '92'
        ]);




        Permission::create([
            'name' => 'get-smsc-binding',
            'description' => 'get a specific smsc binding',
            'handler_id' => '93'
        ]);

        Permission::create([
            'name' => 'add-smsc-binding',
            'description' => 'add new smsc binding',
            'handler_id' => '94'
        ]);

        Permission::create([
            'name' => 'list-smsc-bindings',
            'description' => 'list all smsc bindings',
            'handler_id' => '95'
        ]);

        Permission::create([
            'name' => 'delete-smsc-binding',
            'description' => 'delete a specific smsc binding',
            'handler_id' => '96'
        ]);

        Permission::create([
            'name' => 'update-smsc-binding',
            'description' => 'update a specific smsc binding',
            'handler_id' => '97'
        ]);

        Permission::create([
            'name' => 'search-smsc-binding-column',
            'description' => 'find a specific value for a column of the smsc bindings table',
            'handler_id' => '98'
        ]);




        Permission::create([
            'name' => 'get-sender',
            'description' => 'get a specific sender',
            'handler_id' => '99'
        ]);

        Permission::create([
            'name' => 'add-sender',
            'description' => 'add new sender',
            'handler_id' => '100'
        ]);

        Permission::create([
            'name' => 'list-senders',
            'description' => 'list all senders',
            'handler_id' => '101'
        ]);

        Permission::create([
            'name' => 'get-client-senders',
            'description' => 'get client senders',
            'handler_id' => '102'
        ]);

        Permission::create([
            'name' => 'delete-sender',
            'description' => 'delete a specific sender',
            'handler_id' => '103'
        ]);

        Permission::create([
            'name' => 'update-sender',
            'description' => 'update a specific sender',
            'handler_id' => '104'
        ]);

        Permission::create([
            'name' => 'search-sender-column',
            'description' => 'find a specific value for a column of the senders table',
            'handler_id' => '105'
        ]);




        Permission::create([
            'name' => 'get-sender-connection',
            'description' => 'get a specific sender connection',
            'handler_id' => '106'
        ]);

        Permission::create([
            'name' => 'add-sender-connection',
            'description' => 'add new sender connection',
            'handler_id' => '107'
        ]);

        Permission::create([
            'name' => 'list-senders-connections',
            'description' => 'list all sender connections',
            'handler_id' => '108'
        ]);

        Permission::create([
            'name' => 'get-sender-connections',
            'description' => 'get sender connections',
            'handler_id' => '109'
        ]);

        Permission::create([
            'name' => 'delete-sender-connection',
            'description' => 'delete a specific sender connection',
            'handler_id' => '110'
        ]);

        Permission::create([
            'name' => 'update-sender-connection',
            'description' => 'update a specific sender connection',
            'handler_id' => '111'
        ]);

        Permission::create([
            'name' => 'search-sender-connection-column',
            'description' => 'find a specific value for a column of the sender connections table',
            'handler_id' => '112'
        ]);
    }
}

