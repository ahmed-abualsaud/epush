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
            'name' => 'forget-password',
            'description' => 'forget user password',
            'handler_id' => '5'
        ]);

        Permission::create([
            'name' => 'generate-password',
            'description' => 'generate new password for a specific user',
            'handler_id' => '6'
        ]);

        Permission::create([
            'name' => 'verifiy-account',
            'description' => 'verify user account',
            'handler_id' => '7'
        ]);

        Permission::create([
            'name' => 'list-users',
            'description' => 'get all users',
            'handler_id' => '8'
        ]);

        Permission::create([
            'name' => 'get-user',
            'description' => 'get a specific user',
            'handler_id' => '9'
        ]);

        Permission::create([
            'name' => 'update-user',
            'description' => 'update user data',
            'handler_id' => '10'
        ]);

        Permission::create([
            'name' => 'delete-user',
            'description' => 'delete a specific user',
            'handler_id' => '11'
        ]);

        Permission::create([
            'name' => 'get-user-roles',
            'description' => 'get roles of a specific users',
            'handler_id' => '12'
        ]);

        Permission::create([
            'name' => 'assign-user-roles',
            'description' => 'assign a group of roles to a specific user',
            'handler_id' => '13'
        ]);

        Permission::create([
            'name' => 'unassign-user-roles',
            'description' => 'unassign a group of roles to a specific user',
            'handler_id' => '14'
        ]);

        Permission::create([
            'name' => 'get-user-permissions',
            'description' => 'get permissions of a specific user',
            'handler_id' => '15'
        ]);

        Permission::create([
            'name' => 'get-all-user-permissions',
            'description' => 'get all permissions (roles permissions + standalone permissions) assigned to a specific user',
            'handler_id' => '16'
        ]);


        Permission::create([
            'name' => 'assign-user-permissions',
            'description' => 'assign a group of permissions to a specific user',
            'handler_id' => '17'
        ]);

        Permission::create([
            'name' => 'unassign-user-permissions',
            'description' => 'unassign a group of permissions to a specific user',
            'handler_id' => '18'
        ]);
    
        Permission::create([
            'name' => 'search-user-column',
            'description' => 'find a specific value for a column of the users table',
            'handler_id' => '19'
        ]);




        Permission::create([
            'name' => 'list-roles',
            'description' => 'list all roles',
            'handler_id' => '20'
        ]);

        Permission::create([
            'name' => 'add-role',
            'description' => 'add new role',
            'handler_id' => '21'
        ]);

        Permission::create([
            'name' => 'get-role-permissions',
            'description' => 'get permissions of a specific role',
            'handler_id' => '22'
        ]);

        Permission::create([
            'name' => 'update-role',
            'description' => 'update a specific role',
            'handler_id' => '23'
        ]);

        Permission::create([
            'name' => 'delete-role',
            'description' => 'delete a specific role',
            'handler_id' => '24'
        ]);

        Permission::create([
            'name' => 'assign-role-permissions',
            'description' => 'assign a group of permissions to a specific role',
            'handler_id' => '25'
        ]);

        Permission::create([
            'name' => 'unassign-role-permissions',
            'description' => 'unassign a group of permissions to a specific role',
            'handler_id' => '26'
        ]);




        Permission::create([
            'name' => 'list-permissions',
            'description' => 'list all permissions',
            'handler_id' => '27'
        ]);

        Permission::create([
            'name' => 'update-permission',
            'description' => 'update a specific permission',
            'handler_id' => '28'
        ]);

        Permission::create([
            'name' => 'delete-permission',
            'description' => 'delete a specific permission',
            'handler_id' => '29'
        ]);




        Permission::create([
            'name' => 'list-app-services',
            'description' => 'list all application services',
            'handler_id' => '30'
        ]);

        Permission::create([
            'name' => 'get-app-service-contexts',
            'description' => 'get application service contexts',
            'handler_id' => '31'
        ]);

        Permission::create([
            'name' => 'update-app-service',
            'description' => 'update application service',
            'handler_id' => '32'
        ]);




        Permission::create([
            'name' => 'get-context-handle-groups',
            'description' => 'get context handle group',
            'handler_id' => '33'
        ]);

        Permission::create([
            'name' => 'update-context',
            'description' => 'update service context',
            'handler_id' => '34'
        ]);




        Permission::create([
            'name' => 'get-handle-group-handlers',
            'description' => 'get handlers of a specific handle group',
            'handler_id' => '35'
        ]);

        Permission::create([
            'name' => 'update-handle-group',
            'description' => 'update context handle group',
            'handler_id' => '36'
        ]);




        Permission::create([
            'name' => 'list-handlers',
            'description' => 'get all application handlers',
            'handler_id' => '37'
        ]);
        
        Permission::create([
            'name' => 'update-handler',
            'description' => 'update specific handler',
            'handler_id' => '38'
        ]);

        Permission::create([
            'name' => 'search-handler-column',
            'description' => 'find a specific value for a column of the handlers table',
            'handler_id' => '39'
        ]);





        Permission::create([
            'name' => 'get-file',
            'description' => 'get a specific file',
            'handler_id' => '40'
        ]);

        Permission::create([
            'name' => 'add-file',
            'description' => 'add new file',
            'handler_id' => '41'
        ]);

        Permission::create([
            'name' => 'list-files',
            'description' => 'list all files',
            'handler_id' => '42'
        ]);

        Permission::create([
            'name' => 'delete-file',
            'description' => 'delete a specific file',
            'handler_id' => '43'
        ]);

        Permission::create([
            'name' => 'update-file',
            'description' => 'update a specific file',
            'handler_id' => '44'
        ]);

        Permission::create([
            'name' => 'search-file-column',
            'description' => 'find a specific value for a column of the files table',
            'handler_id' => '45'
        ]);
        
        Permission::create([
            'name' => 'export-excel',
            'description' => 'export file to excel',
            'handler_id' => '46'
        ]);

        Permission::create([
            'name' => 'export-pdf',
            'description' => 'export file to pdf',
            'handler_id' => '47'
        ]);




        Permission::create([
            'name' => 'get-folder',
            'description' => 'get a specific folder',
            'handler_id' => '48'
        ]);

        Permission::create([
            'name' => 'add-folder',
            'description' => 'add new folder',
            'handler_id' => '49'
        ]);

        Permission::create([
            'name' => 'list-folders',
            'description' => 'list all folders',
            'handler_id' => '50'
        ]);

        Permission::create([
            'name' => 'delete-folder',
            'description' => 'delete a specific folder',
            'handler_id' => '51'
        ]);

        Permission::create([
            'name' => 'update-folder',
            'description' => 'update a specific folder',
            'handler_id' => '52'
        ]);

        Permission::create([
            'name' => 'search-folder-column',
            'description' => 'find a specific value for a column of the folders table',
            'handler_id' => '53'
        ]);




        Permission::create([
            'name' => 'get-admin',
            'description' => 'get a specific admin',
            'handler_id' => '54'
        ]);

        Permission::create([
            'name' => 'add-admin',
            'description' => 'add new admin',
            'handler_id' => '55'
        ]);

        Permission::create([
            'name' => 'list-admins',
            'description' => 'list all admins',
            'handler_id' => '56'
        ]);

        Permission::create([
            'name' => 'delete-admin',
            'description' => 'delete a specific admin',
            'handler_id' => '57'
        ]);

        Permission::create([
            'name' => 'update-admin',
            'description' => 'update a specific admin',
            'handler_id' => '58'
        ]);

        Permission::create([
            'name' => 'search-admin-column',
            'description' => 'find a specific value for a column of the admins table',
            'handler_id' => '59'
        ]);




        Permission::create([
            'name' => 'get-client',
            'description' => 'get a specific client',
            'handler_id' => '60'
        ]);

        Permission::create([
            'name' => 'add-client',
            'description' => 'add new client',
            'handler_id' => '61'
        ]);

        Permission::create([
            'name' => 'list-clients',
            'description' => 'list all clients',
            'handler_id' => '62'
        ]);

        Permission::create([
            'name' => 'delete-client',
            'description' => 'delete a specific client',
            'handler_id' => '63'
        ]);

        Permission::create([
            'name' => 'update-client',
            'description' => 'update a specific client',
            'handler_id' => '64'
        ]);

        Permission::create([
            'name' => 'search-client-column',
            'description' => 'find a specific value for a column of the clients table',
            'handler_id' => '65'
        ]);

        Permission::create([
            'name' => 'get-client-senders',
            'description' => 'get client senders',
            'handler_id' => '66'
        ]);

        Permission::create([
            'name' => 'get-client-messages',
            'description' => 'get all messages of a specific client',
            'handler_id' => '67'
        ]);

        Permission::create([
            'name' => 'get-client-message-groups',
            'description' => 'get all message groups of a specific client',
            'handler_id' => '68'
        ]);

        Permission::create([
            'name' => 'get-client-orders',
            'description' => 'get a specific client\'s orders',
            'handler_id' => '69'
        ]);

        Permission::create([
            'name' => 'get-client-latest-order',
            'description' => 'get the latest created order of a specific client',
            'handler_id' => '70'
        ]);




        Permission::create([
            'name' => 'list-pricelists',
            'description' => 'list all pricelists',
            'handler_id' => '71'
        ]);

        Permission::create([
            'name' => 'add-pricelist',
            'description' => 'add new pricelist',
            'handler_id' => '72'
        ]);

        Permission::create([
            'name' => 'get-pricelist',
            'description' => 'get a specific pricelist',
            'handler_id' => '73'
        ]);

        Permission::create([
            'name' => 'update-pricelist',
            'description' => 'update a specific pricelist',
            'handler_id' => '74'
        ]);

        Permission::create([
            'name' => 'delete-pricelist',
            'description' => 'delete a specific pricelist',
            'handler_id' => '75'
        ]);




        Permission::create([
            'name' => 'list-business-fields',
            'description' => 'list all business fields',
            'handler_id' => '76'
        ]);

        Permission::create([
            'name' => 'add-business-field',
            'description' => 'add new business field',
            'handler_id' => '77'
        ]);

        Permission::create([
            'name' => 'get-business-field',
            'description' => 'get a specific business field',
            'handler_id' => '78'
        ]);

        Permission::create([
            'name' => 'update-business-field',
            'description' => 'update a specific business field',
            'handler_id' => '79'
        ]);

        Permission::create([
            'name' => 'delete-business-field',
            'description' => 'delete a specific business field',
            'handler_id' => '80'
        ]);




        Permission::create([
            'name' => 'get-sales',
            'description' => 'get a specific sales',
            'handler_id' => '81'
        ]);

        Permission::create([
            'name' => 'add-sales',
            'description' => 'add new sales',
            'handler_id' => '82'
        ]);

        Permission::create([
            'name' => 'list-sales',
            'description' => 'list all sales',
            'handler_id' => '83'
        ]);

        Permission::create([
            'name' => 'delete-sales',
            'description' => 'delete a specific sales',
            'handler_id' => '84'
        ]);

        Permission::create([
            'name' => 'update-sales',
            'description' => 'update a specific sales',
            'handler_id' => '85'
        ]);




        Permission::create([
            'name' => 'get-country',
            'description' => 'get a specific country',
            'handler_id' => '86'
        ]);

        Permission::create([
            'name' => 'add-country',
            'description' => 'add new country',
            'handler_id' => '87'
        ]);

        Permission::create([
            'name' => 'list-countries',
            'description' => 'list all countries',
            'handler_id' => '88'
        ]);

        Permission::create([
            'name' => 'delete-country',
            'description' => 'delete a specific country',
            'handler_id' => '89'
        ]);

        Permission::create([
            'name' => 'update-country',
            'description' => 'update a specific country',
            'handler_id' => '90'
        ]);

        Permission::create([
            'name' => 'search-country-column',
            'description' => 'find a specific value for a column of the countries table',
            'handler_id' => '91'
        ]);




        Permission::create([
            'name' => 'get-smsc',
            'description' => 'get a specific smsc',
            'handler_id' => '92'
        ]);

        Permission::create([
            'name' => 'add-smsc',
            'description' => 'add new smsc',
            'handler_id' => '93'
        ]);

        Permission::create([
            'name' => 'list-smscs',
            'description' => 'list all smscs',
            'handler_id' => '94'
        ]);

        Permission::create([
            'name' => 'delete-smsc',
            'description' => 'delete a specific smsc',
            'handler_id' => '95'
        ]);

        Permission::create([
            'name' => 'update-smsc',
            'description' => 'update a specific smsc',
            'handler_id' => '96'
        ]);

        Permission::create([
            'name' => 'search-smsc-column',
            'description' => 'find a specific value for a column of the smscs table',
            'handler_id' => '97'
        ]);




        Permission::create([
            'name' => 'get-operator',
            'description' => 'get a specific operator',
            'handler_id' => '98'
        ]);

        Permission::create([
            'name' => 'add-operator',
            'description' => 'add new operator',
            'handler_id' => '99'
        ]);

        Permission::create([
            'name' => 'list-operators',
            'description' => 'list all operators',
            'handler_id' => '100'
        ]);

        Permission::create([
            'name' => 'delete-operator',
            'description' => 'delete a specific operator',
            'handler_id' => '101'
        ]);

        Permission::create([
            'name' => 'update-operator',
            'description' => 'update a specific operator',
            'handler_id' => '102'
        ]);

        Permission::create([
            'name' => 'search-operator-column',
            'description' => 'find a specific value for a column of the operators table',
            'handler_id' => '103'
        ]);




        Permission::create([
            'name' => 'get-smsc-binding',
            'description' => 'get a specific smsc binding',
            'handler_id' => '104'
        ]);

        Permission::create([
            'name' => 'add-smsc-binding',
            'description' => 'add new smsc binding',
            'handler_id' => '105'
        ]);

        Permission::create([
            'name' => 'list-smsc-bindings',
            'description' => 'list all smsc bindings',
            'handler_id' => '106'
        ]);

        Permission::create([
            'name' => 'delete-smsc-binding',
            'description' => 'delete a specific smsc binding',
            'handler_id' => '107'
        ]);

        Permission::create([
            'name' => 'update-smsc-binding',
            'description' => 'update a specific smsc binding',
            'handler_id' => '108'
        ]);

        Permission::create([
            'name' => 'search-smsc-binding-column',
            'description' => 'find a specific value for a column of the smsc bindings table',
            'handler_id' => '109'
        ]);




        Permission::create([
            'name' => 'get-sender',
            'description' => 'get a specific sender',
            'handler_id' => '110'
        ]);

        Permission::create([
            'name' => 'add-sender',
            'description' => 'add new sender',
            'handler_id' => '111'
        ]);

        Permission::create([
            'name' => 'list-senders',
            'description' => 'list all senders',
            'handler_id' => '112'
        ]);

        Permission::create([
            'name' => 'delete-sender',
            'description' => 'delete a specific sender',
            'handler_id' => '113'
        ]);

        Permission::create([
            'name' => 'update-sender',
            'description' => 'update a specific sender',
            'handler_id' => '114'
        ]);

        Permission::create([
            'name' => 'search-sender-column',
            'description' => 'find a specific value for a column of the senders table',
            'handler_id' => '115'
        ]);




        Permission::create([
            'name' => 'get-sender-connection',
            'description' => 'get a specific sender connection',
            'handler_id' => '116'
        ]);

        Permission::create([
            'name' => 'add-sender-connection',
            'description' => 'add new sender connection',
            'handler_id' => '117'
        ]);

        Permission::create([
            'name' => 'list-senders-connections',
            'description' => 'list all sender connections',
            'handler_id' => '118'
        ]);

        Permission::create([
            'name' => 'get-sender-connections',
            'description' => 'get sender connections',
            'handler_id' => '119'
        ]);

        Permission::create([
            'name' => 'delete-sender-connection',
            'description' => 'delete a specific sender connection',
            'handler_id' => '120'
        ]);

        Permission::create([
            'name' => 'update-sender-connection',
            'description' => 'update a specific sender connection',
            'handler_id' => '121'
        ]);

        Permission::create([
            'name' => 'search-sender-connection-column',
            'description' => 'find a specific value for a column of the sender connections table',
            'handler_id' => '122'
        ]);




        Permission::create([
            'name' => 'list-messages',
            'description' => 'list all messages handlers',
            'handler_id' => '123'
        ]);

        Permission::create([
            'name' => 'add-message',
            'description' => 'add new message',
            'handler_id' => '124'
        ]);

        Permission::create([
            'name' => 'bulk-add-message',
            'description' => 'bulk add new message',
            'handler_id' => '125'
        ]);

        Permission::create([
            'name' => 'get-message',
            'description' => 'get a specific message',
            'handler_id' => '126'
        ]);

        Permission::create([
            'name' => 'update-message',
            'description' => 'update a specific message',
            'handler_id' => '127'
        ]);

        Permission::create([
            'name' => 'delete-message',
            'description' => 'delete a specific message',
            'handler_id' => '128'
        ]);

        Permission::create([
            'name' => 'search-message-column',
            'description' => 'find a specific value for a column of the messages table',
            'handler_id' => '129'
        ]);

        Permission::create([
            'name' => 'get-message-recipients',
            'description' => 'get the recipients of a message',
            'handler_id' => '130'
        ]);





        Permission::create([
            'name' => 'list-message-languages',
            'description' => 'list all message languages handlers',
            'handler_id' => '131'
        ]);

        Permission::create([
            'name' => 'add-message-language',
            'description' => 'add new message language',
            'handler_id' => '132'
        ]);

        Permission::create([
            'name' => 'get-message-language',
            'description' => 'get a specific message language',
            'handler_id' => '133'
        ]);

        Permission::create([
            'name' => 'update-message-language',
            'description' => 'update a specific message language',
            'handler_id' => '134'
        ]);

        Permission::create([
            'name' => 'delete-message-language',
            'description' => 'delete a specific message language',
            'handler_id' => '135'
        ]);

        Permission::create([
            'name' => 'search-message-language-column',
            'description' => 'find a specific value for a column of the message languages table',
            'handler_id' => '136'
        ]);




        Permission::create([
            'name' => 'list-message-segments',
            'description' => 'list all message segments handlers',
            'handler_id' => '137'
        ]);

        Permission::create([
            'name' => 'add-message-segment',
            'description' => 'add new message segment',
            'handler_id' => '138'
        ]);

        Permission::create([
            'name' => 'get-message-segment',
            'description' => 'get a specific message segment',
            'handler_id' => '139'
        ]);

        Permission::create([
            'name' => 'update-message-segment',
            'description' => 'update a specific message segment',
            'handler_id' => '140'
        ]);

        Permission::create([
            'name' => 'delete-message-segment',
            'description' => 'delete a specific message segment',
            'handler_id' => '141'
        ]);

        Permission::create([
            'name' => 'search-message-segment-column',
            'description' => 'find a specific value for a column of the message segments table',
            'handler_id' => '142'
        ]);




        Permission::create([
            'name' => 'list-message-recipients',
            'description' => 'list all message recipients handlers',
            'handler_id' => '143'
        ]);

        Permission::create([
            'name' => 'add-message-recipient',
            'description' => 'add new message recipient',
            'handler_id' => '144'
        ]);

        Permission::create([
            'name' => 'get-message-recipient',
            'description' => 'get a specific message recipient',
            'handler_id' => '145'
        ]);

        Permission::create([
            'name' => 'update-message-recipient',
            'description' => 'update a specific message recipient',
            'handler_id' => '146'
        ]);

        Permission::create([
            'name' => 'delete-message-recipient',
            'description' => 'delete a specific message recipient',
            'handler_id' => '147'
        ]);

        Permission::create([
            'name' => 'search-message-recipient-column',
            'description' => 'find a specific value for a column of the message recipients table',
            'handler_id' => '148'
        ]);




        Permission::create([
            'name' => 'list-message-groups',
            'description' => 'list all message groups handlers',
            'handler_id' => '149'
        ]);

        Permission::create([
            'name' => 'add-message-group',
            'description' => 'add new message group',
            'handler_id' => '150'
        ]);

        Permission::create([
            'name' => 'get-message-group',
            'description' => 'get a specific message group',
            'handler_id' => '151'
        ]);

        Permission::create([
            'name' => 'update-message-group',
            'description' => 'update a specific message group',
            'handler_id' => '152'
        ]);

        Permission::create([
            'name' => 'delete-message-group',
            'description' => 'delete a specific message group',
            'handler_id' => '153'
        ]);

        Permission::create([
            'name' => 'search-message-group-column',
            'description' => 'find a specific value for a column of the message groups table',
            'handler_id' => '154'
        ]);

        Permission::create([
            'name' => 'get-message-group-recipients',
            'description' => 'get the recipients of a message group',
            'handler_id' => '155'
        ]);




        Permission::create([
            'name' => 'list-message-group-recipients',
            'description' => 'list all message group recipients handlers',
            'handler_id' => '156'
        ]);

        Permission::create([
            'name' => 'add-message-group-recipient',
            'description' => 'add new message group recipient',
            'handler_id' => '157'
        ]);

        Permission::create([
            'name' => 'get-message-group-recipient',
            'description' => 'get a specific message group recipient',
            'handler_id' => '158'
        ]);

        Permission::create([
            'name' => 'update-message-group-recipient',
            'description' => 'update a specific message group recipient',
            'handler_id' => '159'
        ]);

        Permission::create([
            'name' => 'delete-message-group-recipient',
            'description' => 'delete a specific message group recipient',
            'handler_id' => '160'
        ]);

        Permission::create([
            'name' => 'search-message-group-recipient-column',
            'description' => 'find a specific value for a column of the message group recipients table',
            'handler_id' => '161'
        ]);




        Permission::create([
            'name' => 'list-message-filters',
            'description' => 'list all message filters handlers',
            'handler_id' => '162'
        ]);

        Permission::create([
            'name' => 'add-message-filter',
            'description' => 'add new message filter',
            'handler_id' => '163'
        ]);

        Permission::create([
            'name' => 'get-message-filter',
            'description' => 'get a specific message filter',
            'handler_id' => '164'
        ]);

        Permission::create([
            'name' => 'update-message-filter',
            'description' => 'update a specific message filter',
            'handler_id' => '165'
        ]);

        Permission::create([
            'name' => 'delete-message-filter',
            'description' => 'delete a specific message filter',
            'handler_id' => '166'
        ]);

        Permission::create([
            'name' => 'search-message-filter-column',
            'description' => 'find a specific value for a column of the message filters table',
            'handler_id' => '167'
        ]);




        Permission::create([
            'name' => 'list-payment-methods',
            'description' => 'list all payment methods',
            'handler_id' => '168'
        ]);

        Permission::create([
            'name' => 'add-payment-method',
            'description' => 'add new payment method',
            'handler_id' => '169'
        ]);

        Permission::create([
            'name' => 'get-payment-method',
            'description' => 'get a specific payment method',
            'handler_id' => '170'
        ]);

        Permission::create([
            'name' => 'update-payment-method',
            'description' => 'update a specific payment method',
            'handler_id' => '171'
        ]);

        Permission::create([
            'name' => 'delete-payment-method',
            'description' => 'delete a specific payment method',
            'handler_id' => '172'
        ]);



        Permission::create([
            'name' => 'list-orders',
            'description' => 'list all orders',
            'handler_id' => '173'
        ]);

        Permission::create([
            'name' => 'add-order',
            'description' => 'add new order',
            'handler_id' => '174'
        ]);

        Permission::create([
            'name' => 'get-order',
            'description' => 'get a specific order',
            'handler_id' => '175'
        ]);

        Permission::create([
            'name' => 'update-order',
            'description' => 'update a specific order',
            'handler_id' => '176'
        ]);

        Permission::create([
            'name' => 'search-order-column',
            'description' => 'find a specific value for a column of the orders table',
            'handler_id' => '177'
        ]);




        Permission::create([
            'name' => 'list-mail-templates',
            'description' => 'list all mail templates',
            'handler_id' => '178'
        ]);

        Permission::create([
            'name' => 'add-mail-template',
            'description' => 'add new mail template',
            'handler_id' => '179'
        ]);

        Permission::create([
            'name' => 'get-mail-template',
            'description' => 'get a specific mail template',
            'handler_id' => '180'
        ]);

        Permission::create([
            'name' => 'update-mail-template',
            'description' => 'update a specific mail template',
            'handler_id' => '181'
        ]);

        Permission::create([
            'name' => 'delete-mail-template',
            'description' => 'delete a specific mail template',
            'handler_id' => '182'
        ]);




        Permission::create([
            'name' => 'list-mail-sending-handlers',
            'description' => 'list all mail sending handlers',
            'handler_id' => '183'
        ]);

        Permission::create([
            'name' => 'add-mail-sending-handler',
            'description' => 'add new mail sending handler',
            'handler_id' => '184'
        ]);

        Permission::create([
            'name' => 'get-mail-sending-handler',
            'description' => 'get a specific mail sending handler',
            'handler_id' => '185'
        ]);

        Permission::create([
            'name' => 'update-mail-sending-handler',
            'description' => 'update a specific mail sending handler',
            'handler_id' => '186'
        ]);

        Permission::create([
            'name' => 'delete-mail-sending-handler',
            'description' => 'delete a specific mail sending handler',
            'handler_id' => '187'
        ]);

        Permission::create([
            'name' => 'search-mail-sending-handler',
            'description' => 'search a specific mail sending handler',
            'handler_id' => '188'
        ]);




        Permission::create([
            'name' => 'list-sms-templates',
            'description' => 'list all sms templates',
            'handler_id' => '189'
        ]);

        Permission::create([
            'name' => 'add-sms-template',
            'description' => 'add new sms template',
            'handler_id' => '190'
        ]);

        Permission::create([
            'name' => 'get-sms-template',
            'description' => 'get a specific sms template',
            'handler_id' => '191'
        ]);

        Permission::create([
            'name' => 'update-sms-template',
            'description' => 'update a specific sms template',
            'handler_id' => '192'
        ]);

        Permission::create([
            'name' => 'delete-sms-template',
            'description' => 'delete a specific sms template',
            'handler_id' => '193'
        ]);




        Permission::create([
            'name' => 'list-sms-sending-handlers',
            'description' => 'list all sms sending handlers',
            'handler_id' => '194'
        ]);

        Permission::create([
            'name' => 'add-sms-sending-handler',
            'description' => 'add new sms sending handler',
            'handler_id' => '195'
        ]);

        Permission::create([
            'name' => 'get-sms-sending-handler',
            'description' => 'get a specific sms sending handler',
            'handler_id' => '196'
        ]);

        Permission::create([
            'name' => 'update-sms-sending-handler',
            'description' => 'update a specific sms sending handler',
            'handler_id' => '197'
        ]);

        Permission::create([
            'name' => 'delete-sms-sending-handler',
            'description' => 'delete a specific sms sending handler',
            'handler_id' => '198'
        ]);

        Permission::create([
            'name' => 'search-sms-sending-handler',
            'description' => 'search a specific sms sending handler',
            'handler_id' => '199'
        ]);




        Permission::create([
            'name' => 'list-notification-templates',
            'description' => 'list all notification templates',
            'handler_id' => '200'
        ]);

        Permission::create([
            'name' => 'add-notification-template',
            'description' => 'add new notification template',
            'handler_id' => '201'
        ]);

        Permission::create([
            'name' => 'get-notification-template',
            'description' => 'get a specific notification template',
            'handler_id' => '202'
        ]);

        Permission::create([
            'name' => 'update-notification-template',
            'description' => 'update a specific notification template',
            'handler_id' => '203'
        ]);

        Permission::create([
            'name' => 'delete-notification-template',
            'description' => 'delete a specific notification template',
            'handler_id' => '204'
        ]);




        Permission::create([
            'name' => 'list-notification-sending-handlers',
            'description' => 'list all notification sending handlers',
            'handler_id' => '205'
        ]);

        Permission::create([
            'name' => 'add-notification-sending-handler',
            'description' => 'add new notification sending handler',
            'handler_id' => '206'
        ]);

        Permission::create([
            'name' => 'get-notification-sending-handler',
            'description' => 'get a specific notification sending handler',
            'handler_id' => '207'
        ]);

        Permission::create([
            'name' => 'update-notification-sending-handler',
            'description' => 'update a specific notification sending handler',
            'handler_id' => '208'
        ]);

        Permission::create([
            'name' => 'delete-notification-sending-handler',
            'description' => 'delete a specific notification sending handler',
            'handler_id' => '209'
        ]);

        Permission::create([
            'name' => 'search-notification-sending-handler',
            'description' => 'search a specific notification sending handler',
            'handler_id' => '210'
        ]);
        



        Permission::create([
            'name' => 'list-user-notifications',
            'description' => 'list all user notifications',
            'handler_id' => '211'
        ]);

        Permission::create([
            'name' => 'add-user-notification',
            'description' => 'add new user notification',
            'handler_id' => '212'
        ]);

        Permission::create([
            'name' => 'get-user-notification',
            'description' => 'get a specific user notification',
            'handler_id' => '213'
        ]);

        Permission::create([
            'name' => 'get-user-notifications',
            'description' => 'get notifications of a specific user',
            'handler_id' => '214'
        ]);

        Permission::create([
            'name' => 'get-user-unread-notifications',
            'description' => 'get unread notifications of a specific user',
            'handler_id' => '215'
        ]);

        Permission::create([
            'name' => 'update-user-notification',
            'description' => 'update a specific user notification',
            'handler_id' => '216'
        ]);

        Permission::create([
            'name' => 'update-user-notifications',
            'description' => 'update notifications of a specific user',
            'handler_id' => '217'
        ]);

        Permission::create([
            'name' => 'delete-user-notification',
            'description' => 'delete a specific user notification',
            'handler_id' => '218'
        ]);

        Permission::create([
            'name' => 'search-user-notification',
            'description' => 'search a specific user notification',
            'handler_id' => '219'
        ]);

        


        Permission::create([
            'name' => 'list-settings',
            'description' => 'list all settings handlers',
            'handler_id' => '220'
        ]);

        Permission::create([
            'name' => 'add-settings',
            'description' => 'add new settings',
            'handler_id' => '221'
        ]);

        Permission::create([
            'name' => 'get-settings',
            'description' => 'get a specific settings',
            'handler_id' => '222'
        ]);

        Permission::create([
            'name' => 'update-settings',
            'description' => 'update a specific settings',
            'handler_id' => '223'
        ]);

        Permission::create([
            'name' => 'delete-settings',
            'description' => 'delete a specific settings',
            'handler_id' => '224'
        ]);

        Permission::create([
            'name' => 'search-settings-column',
            'description' => 'find a specific value for a column of the settings table',
            'handler_id' => '225'
        ]);




        Permission::create([
            'name' => 'search',
            'description' => 'execute an encrepted mysql query to search in multiple cross-cutting databases tables',
            'handler_id' => '226'
        ]);




        Permission::create([
            'name' => 'get-ticket',
            'description' => 'get a specific ticket',
            'handler_id' => '227'
        ]);

        Permission::create([
            'name' => 'add-ticket',
            'description' => 'add new ticket',
            'handler_id' => '228'
        ]);

        Permission::create([
            'name' => 'list-tickets',
            'description' => 'list all tickets',
            'handler_id' => '229'
        ]);

        Permission::create([
            'name' => 'delete-ticket',
            'description' => 'delete a specific ticket',
            'handler_id' => '230'
        ]);

        Permission::create([
            'name' => 'update-ticket',
            'description' => 'update a specific ticket',
            'handler_id' => '231'
        ]);

        Permission::create([
            'name' => 'search-ticket-column',
            'description' => 'find a specific value for a column of the tickets table',
            'handler_id' => '232'
        ]);




        Permission::create([
            'name' => 'send-message',
            'description' => 'use service api to send message',
            'handler_id' => '233'
        ]);

        Permission::create([
            'name' => 'send-bulk-get',
            'description' => 'use old service api to send message using get request',
            'handler_id' => '234'
        ]);

        Permission::create([
            'name' => 'send-bulk-post',
            'description' => 'use old service api to send message using post request',
            'handler_id' => '235'
        ]);

        Permission::create([
            'name' => 'check-balance',
            'description' => 'use old service api to check client balance',
            'handler_id' => '236'
        ]);




        Permission::create([
            'name' => 'change-password',
            'description' => 'change user password',
            'handler_id' => '237'
        ]);

    



        Permission::create([
            'name' => 'get-ipwhitelist',
            'description' => 'get a specific ipwhitelist',
            'handler_id' => '238'
        ]);

        Permission::create([
            'name' => 'add-ipwhitelist',
            'description' => 'add new ipwhitelist',
            'handler_id' => '239'
        ]);

        Permission::create([
            'name' => 'list-ipwhitelists',
            'description' => 'list all ipwhitelists',
            'handler_id' => '240'
        ]);

        Permission::create([
            'name' => 'delete-ipwhitelist',
            'description' => 'delete a specific ipwhitelist',
            'handler_id' => '241'
        ]);

        Permission::create([
            'name' => 'update-ipwhitelist',
            'description' => 'update a specific ipwhitelist',
            'handler_id' => '242'
        ]);

        Permission::create([
            'name' => 'get-client-ipwhitelist',
            'description' => 'get client ip whitelist',
            'handler_id' => '243'
        ]);




        Permission::create([
            'name' => 'get-partner',
            'description' => 'get a specific partner',
            'handler_id' => '244'
        ]);

        Permission::create([
            'name' => 'add-partner',
            'description' => 'add new partner',
            'handler_id' => '245'
        ]);

        Permission::create([
            'name' => 'list-partners',
            'description' => 'list all partners',
            'handler_id' => '246'
        ]);

        Permission::create([
            'name' => 'delete-partner',
            'description' => 'delete a specific partner',
            'handler_id' => '247'
        ]);

        Permission::create([
            'name' => 'update-partner',
            'description' => 'update a specific partner',
            'handler_id' => '248'
        ]);

        Permission::create([
            'name' => 'search-partner-column',
            'description' => 'find a specific value for a column of the partners table',
            'handler_id' => '249'
        ]);




        Permission::create([
            'name' => 'get-message-report',
            'description' => 'get a specific message report',
            'handler_id' => '250'
        ]);

        Permission::create([
            'name' => 'add-message-report',
            'description' => 'add new message report',
            'handler_id' => '251'
        ]);

        Permission::create([
            'name' => 'list-message-reports',
            'description' => 'list all message reports',
            'handler_id' => '252'
        ]);

        Permission::create([
            'name' => 'delete-message-report',
            'description' => 'delete a specific message report',
            'handler_id' => '253'
        ]);

        Permission::create([
            'name' => 'update-message-report',
            'description' => 'update a specific message report',
            'handler_id' => '254'
        ]);

        Permission::create([
            'name' => 'search-message-report-column',
            'description' => 'find a specific value for a column of the message reports table',
            'handler_id' => '255'
        ]);

        Permission::create([
            'name' => 'get-message-client-reports',
            'description' => 'get the number of messages for a specific client grouped by month',
            'handler_id' => '256'
        ]);
    }
}

