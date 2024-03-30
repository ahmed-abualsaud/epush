<?php

namespace Epush\Shared\Infra\InterprocessCommunication;

use Illuminate\Support\ServiceProvider;

use Epush\SMS\App\Service\SMSService;
use Epush\Mail\App\Service\MailService;
use Epush\Ticket\App\Service\TicketService;
use Epush\Auth\User\App\Service\UserService;
use Epush\Core\Admin\App\Service\AdminService;
use Epush\Core\Banner\App\Service\BannerService;
use Epush\Core\Client\App\Service\ClientService;
use Epush\Expense\Order\App\Service\OrderService;
use Epush\Core\Message\App\Service\MessageService;
use Epush\Notification\App\Service\NotificationService;
use Epush\Core\MessageGroup\App\Service\MessageGroupService;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Cache\App\Contract\CacheServiceContract;
use Epush\Search\App\Contract\SearchServiceContract;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Core\Sender\App\Contract\SenderDatabaseServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\AddUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendSMSMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetUsersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendMailMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\StoreFileMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendToMailMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\DeleteFileMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\UpdateUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\DeleteUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\AddToCacheMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\PutToCacheMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetSettingsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetAuthUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetFromCacheMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetPricelistMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetOrdersByIDMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetPricelistsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\UpdateHandlerMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\PutManyToCacheMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetAllSettingsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientOrdersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendNotificationMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GeneratePasswordMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchUserColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetSystemHandlerMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientSendersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetSystemHandlersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchSalesColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchOrderColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientMessagesMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetUserByUsernameMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\AttemptCredentialsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchClientColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\UpdateClientWalletMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientsBySalesIDMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchHandlerColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetHandlerByEndpointMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientLatestOrderMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientIPWhitelistMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchPricelistColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientMessageGroupsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientMessagesStatsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetAllHandlersResponseAttributesMicroprocess;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class InterprocessCommunicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(UserService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new StoreFileMicroprocess(app(FileServiceContract::class)), "file:store");
                $engine->attach(new DeleteFileMicroprocess(app(FileServiceContract::class)), "file:delete");
                $engine->attach(new SendToMailMicroprocess(app(MailServiceContract::class)), "mail:send-to");
                $engine->attach(new GetSystemHandlersMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handlers-by-id");

                return $engine;
            });


        $this->app
            ->when(AdminService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new GetUserMicroprocess(app(UserServiceContract::class)), "auth:user:get-user");
                $engine->attach(new AddUserMicroprocess(app(UserServiceContract::class)), "auth:user:add-user");
                $engine->attach(new GetUsersMicroprocess(app(UserServiceContract::class)), "auth:user:get-users");
                $engine->attach(new UpdateUserMicroprocess(app(UserServiceContract::class)), "auth:user:update-user");
                $engine->attach(new DeleteUserMicroprocess(app(UserServiceContract::class)), "auth:user:delete-user");
                $engine->attach(new SearchUserColumnMicroprocess(app(UserServiceContract::class)), "auth:user:search-column");
                $engine->attach(new GeneratePasswordMicroprocess(app(CredentialsServiceContract::class)), "auth:credentials:generate-password");
                $engine->attach(new SendMailMicroprocess(app(MailServiceContract::class)), "mail:send");

                return $engine;
            });


        $this->app
            ->when(ClientService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new GetUserMicroprocess(app(UserServiceContract::class)), "auth:user:get-user");
                $engine->attach(new AddUserMicroprocess(app(UserServiceContract::class)), "auth:user:add-user");
                $engine->attach(new GetUsersMicroprocess(app(UserServiceContract::class)), "auth:user:get-users");
                $engine->attach(new UpdateUserMicroprocess(app(UserServiceContract::class)), "auth:user:update-user");
                $engine->attach(new DeleteUserMicroprocess(app(UserServiceContract::class)), "auth:user:delete-user");
                $engine->attach(new SearchUserColumnMicroprocess(app(UserServiceContract::class)), "auth:user:search-column");
                $engine->attach(new GetClientOrdersMicroprocess(app(OrderDatabaseServiceContract::class)), "expense:order:get-client-orders");
                $engine->attach(new GetClientSendersMicroprocess(app(SenderDatabaseServiceContract::class)), "core:sender:get-client-senders");
                $engine->attach(new GetClientMessagesMicroprocess(app(MessageDatabaseServiceContract::class)), "core:message:get-client-messages");
                $engine->attach(new GetClientIPWhitelistMicroprocess(app(IPWhitelistServiceContract::class)), "core:ipwhitelist:get-client-ipwhitelist");
                $engine->attach(new GetClientMessagesStatsMicroprocess(app(MessageDatabaseServiceContract::class)), "core:message:get-client-messages-stats");
                $engine->attach(new GetClientMessageGroupsMicroprocess(app(MessageGroupDatabaseServiceContract::class)), "core:message-group:get-client-message-groups");
                $engine->attach(new GetClientLatestOrderMicroprocess(app(OrderDatabaseServiceContract::class)), "expense:order:get-client-latest-order");
                $engine->attach(new GeneratePasswordMicroprocess(app(CredentialsServiceContract::class)), "auth:credentials:generate-password");

                return $engine;
            });

        
        $this->app
            ->when(OrderService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();
    
                $engine->attach(new GetClientMicroprocess(app(ClientServiceContract::class)), "core:client:get-client");
                $engine->attach(new GetClientsMicroprocess(app(ClientServiceContract::class)), "core:client:get-clients");
                $engine->attach(new SearchClientColumnMicroprocess(app(ClientServiceContract::class)), "core:client:search-column");
                $engine->attach(new UpdateClientWalletMicroprocess(app(ClientServiceContract::class)), "core:client:update-client-wallet");
                $engine->attach(new GetClientsBySalesIDMicroprocess(app(ClientServiceContract::class)), "core:client:get-clients-by-sales-id");  
                $engine->attach(new GetPricelistMicroprocess(app(PricelistServiceContract::class)), "core:pricelist:get-pricelist");
                $engine->attach(new GetPricelistsMicroprocess(app(PricelistServiceContract::class)), "core:pricelist:get-pricelists");
                $engine->attach(new SearchPricelistColumnMicroprocess(app(PricelistServiceContract::class)), "core:pricelist:search-column");
                $engine->attach(new SearchSalesColumnMicroprocess(app(SalesServiceContract::class)), "core:sales:search-column");

                return $engine;
            });


        $this->app
            ->when(MessageService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new GetSettingsMicroprocess(app(SettingsServiceContract::class)), "settings:get");
                $engine->attach(new GetAllSettingsMicroprocess(app(SettingsServiceContract::class)), "settings:all");
                $engine->attach(new GetClientMicroprocess(app(ClientServiceContract::class)), "core:client:get-client");
                $engine->attach(new GetAuthUserMicroprocess(app(CredentialsServiceContract::class)), "auth:user:get-auth-user");
                $engine->attach(new GetOrdersByIDMicroprocess(app(OrderServiceContract::class)), "expense:order:get-orders-by-id");
                $engine->attach(new SearchOrderColumnMicroprocess(app(OrderServiceContract::class)), "expense:order:search-column");
                $engine->attach(new GetUserByUsernameMicroprocess(app(UserServiceContract::class)), "auth:user:get-user-by-username");
                $engine->attach(new UpdateClientWalletMicroprocess(app(ClientServiceContract::class)), "core:client:update-client-wallet");
                $engine->attach(new AttemptCredentialsMicroprocess(app(CredentialsServiceContract::class)), "auth:user:attempt-credentials");
                $engine->attach(new GetClientLatestOrderMicroprocess(app(OrderDatabaseServiceContract::class)), "expense:order:get-client-latest-order");
                $engine->attach(new SearchClientColumnMicroprocess(app(ClientServiceContract::class)), "core:client:search-column");
                $engine->attach(new GetClientsMicroprocess(app(ClientServiceContract::class)), "core:client:get-clients");
                $engine->attach(new SendToMailMicroprocess(app(MailServiceContract::class)), "mail:send-to");


                return $engine;
            });

        
        $this->app
            ->when(MessageGroupService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new GetClientMicroprocess(app(ClientServiceContract::class)), "core:client:get-client");
                $engine->attach(new GetClientsMicroprocess(app(ClientServiceContract::class)), "core:client:get-clients");
                $engine->attach(new SearchClientColumnMicroprocess(app(ClientServiceContract::class)), "core:client:search-column");

                return $engine;
            });


        $this->app
            ->when(MailService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new AddToCacheMicroprocess(app(CacheServiceContract::class)), "cache:add");
                $engine->attach(new GetFromCacheMicroprocess(app(CacheServiceContract::class)), "cache:get");
                $engine->attach(new UpdateHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:update");
                $engine->attach(new SearchHandlerColumnMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:search-column");
                $engine->attach(new GetSystemHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-id");
                $engine->attach(new GetSystemHandlersMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handlers-by-id");
                $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");

                return $engine;
            });


        $this->app
            ->when(SMSService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new AddToCacheMicroprocess(app(CacheServiceContract::class)), "cache:add");
                $engine->attach(new GetFromCacheMicroprocess(app(CacheServiceContract::class)), "cache:get");
                $engine->attach(new UpdateHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:update");
                $engine->attach(new SearchHandlerColumnMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:search-column");
                $engine->attach(new GetSystemHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-id");
                $engine->attach(new GetSystemHandlersMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handlers-by-id");
                $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");

                return $engine;
            });


        $this->app
            ->when(NotificationService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new AddToCacheMicroprocess(app(CacheServiceContract::class)), "cache:add");
                $engine->attach(new GetFromCacheMicroprocess(app(CacheServiceContract::class)), "cache:get");
                $engine->attach(new UpdateHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:update");
                $engine->attach(new SearchHandlerColumnMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:search-column");
                $engine->attach(new GetSystemHandlerMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-id");
                $engine->attach(new GetSystemHandlersMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handlers-by-id");
                $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");

                return $engine;
            });


        $this->app
            ->when(TicketService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new SendToMailMicroprocess(app(MailServiceContract::class)), "mail:send-to");

                return $engine;
            });


        $this->app
            ->when(BannerService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new StoreFileMicroprocess(app(FileServiceContract::class)), "file:store");
                $engine->attach(new DeleteFileMicroprocess(app(FileServiceContract::class)), "file:delete");

                return $engine;
            });

        $this->app->bind(InterprocessCommunicationEngineContract::class, function () {

            $engine = new InterprocessCommunicationEngine();

            $engine->attach(new SendSMSMicroprocess(app(SMSServiceContract::class)), "sms:send");
            $engine->attach(new SendMailMicroprocess(app(MailServiceContract::class)), "mail:send");
            $engine->attach(new SearchMicroprocess(app(SearchServiceContract::class)), "search:search-query");
            $engine->attach(new SendNotificationMicroprocess(app(NotificationServiceContract::class)), "notification:send");
            $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");
            $engine->attach(new GetAllHandlersResponseAttributesMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handlers:get-all-handlers-response-attributes");
            $engine->attach(new PutToCacheMicroprocess(app(CacheServiceContract::class)), "cache:put");
            $engine->attach(new GetFromCacheMicroprocess(app(CacheServiceContract::class)), "cache:get");
            $engine->attach(new PutManyToCacheMicroprocess(app(CacheServiceContract::class)), "cache:put-many");

            return $engine;
        });
    }
}