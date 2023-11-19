<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Orchi\Infra\Database\Model\HandleGroup;
use Illuminate\Database\Seeder;

class HandleGroupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1
        HandleGroup::create([
            'context_id' => 1,
            'name' => 'UserController',
            'description' => 'Controller holds all user endpoints',
            'enabled' => true,
            'num_of_handlers' => 4,
            'num_of_enabled_handlers' => 4
        ]);
        // 2
        HandleGroup::create([
            'context_id' => 1,
            'name' => 'RoleController',
            'description' => 'Controller holds all role endpoints',
            'enabled' => true,
            'num_of_handlers' => 4,
            'num_of_enabled_handlers' => 4
        ]);
        // 3
        HandleGroup::create([
            'context_id' => 1,
            'name' => 'PermissionController',
            'description' => 'Controller holds all permission endpoints',
            'enabled' => true,
            'num_of_handlers' => 4,
            'num_of_enabled_handlers' => 4
        ]);
        // 4
        HandleGroup::create([
            'context_id' => 2,
            'name' => 'AppServiceController',
            'description' => 'Controller holds all app services endpoints',
            'enabled' => true,
            'num_of_handlers' => 3,
            'num_of_enabled_handlers' => 3
        ]);
        // 5
        HandleGroup::create([
            'context_id' => 2,
            'name' => 'ContextController',
            'description' => 'Controller holds all service contexts endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);
        // 6
        HandleGroup::create([
            'context_id' => 2,
            'name' => 'HandleGroupController',
            'description' => 'Controller holds all context handle groups endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);
        // 7
        HandleGroup::create([
            'context_id' => 2,
            'name' => 'HandlerController',
            'description' => 'Controller holds all handle group handlers endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 8
        HandleGroup::create([
            'context_id' => 3,
            'name' => 'FileController',
            'description' => 'Controller holds all file endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);
        // 9
        HandleGroup::create([
            'context_id' => 3,
            'name' => 'FolderController',
            'description' => 'Controller holds all folder endpoints',
            'enabled' => true,
            'num_of_handlers' => 2,
            'num_of_enabled_handlers' => 2
        ]);
        // 10
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'AdminController',
            'description' => 'Controller holds all admin endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 11
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'ClientController',
            'description' => 'Controller holds all client endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 12
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'PricelistController',
            'description' => 'Controller holds all pricelist endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 13
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'BusinessFieldController',
            'description' => 'Controller holds all business field endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 14
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'SalesController',
            'description' => 'Controller holds all sales endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 15
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'CountryController',
            'description' => 'Controller holds all country endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 16
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'SMSCController',
            'description' => 'Controller holds all smsc endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 17
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'OperatorController',
            'description' => 'Controller holds all operator endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 18
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'SMSCBindingController',
            'description' => 'Controller holds all smsc binding endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 19
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'SenderController',
            'description' => 'Controller holds all sender endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 20
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'SenderConnectionController',
            'description' => 'Controller holds all sender connection endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 21
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageController',
            'description' => 'Controller holds all message endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 22
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageLanguageController',
            'description' => 'Controller holds all message language endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 23
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageSegmentController',
            'description' => 'Controller holds all message segment endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 24
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageRecipientController',
            'description' => 'Controller holds all message recipient endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        //25
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageGroupController',
            'description' => 'Controller holds all message group endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        //26
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageGroupRecipientController',
            'description' => 'Controller holds all message group recipient endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        //27
        HandleGroup::create([
            'context_id' => 4,
            'name' => 'MessageFilterController',
            'description' => 'Controller holds all message group recipient endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 28
        HandleGroup::create([
            'context_id' => 5,
            'name' => 'PaymentMethodController',
            'description' => 'Controller holds all payment method endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 29
        HandleGroup::create([
            'context_id' => 5,
            'name' => 'OrderController',
            'description' => 'Controller holds all order endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 30
        HandleGroup::create([
            'context_id' => 6,
            'name' => 'MailTemplateController',
            'description' => 'Controller holds all mail template endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 31
        HandleGroup::create([
            'context_id' => 6,
            'name' => 'MailSendingHandlerController',
            'description' => 'Controller holds all mail sending handler endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 32
        HandleGroup::create([
            'context_id' => 7,
            'name' => 'SMSTemplateController',
            'description' => 'Controller holds all sms template endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 33
        HandleGroup::create([
            'context_id' => 7,
            'name' => 'SMSSendingHandlerController',
            'description' => 'Controller holds all sms sending handler endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 34
        HandleGroup::create([
            'context_id' => 8,
            'name' => 'NotificationTemplateController',
            'description' => 'Controller holds all notification template endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 35
        HandleGroup::create([
            'context_id' => 8,
            'name' => 'NotificationSendingHandlerController',
            'description' => 'Controller holds all notification sending handler endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 33
        HandleGroup::create([
            'context_id' => 8,
            'name' => 'UserNotificationController',
            'description' => 'Controller holds all user notification endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 37
        HandleGroup::create([
            'context_id' => 9,
            'name' => 'SettingsController',
            'description' => 'Controller holds all settings endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 38
        HandleGroup::create([
            'context_id' => 10,
            'name' => 'SearchController',
            'description' => 'Controller holds all search endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
        // 39
        HandleGroup::create([
            'context_id' => 10,
            'name' => 'TicketController',
            'description' => 'Controller holds all ticketing system endpoints',
            'enabled' => true,
            'num_of_handlers' => 1,
            'num_of_enabled_handlers' => 1
        ]);
    }
}

