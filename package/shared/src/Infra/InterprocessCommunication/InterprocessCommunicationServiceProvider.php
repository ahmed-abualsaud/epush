<?php

namespace Epush\Shared\Infra\InterprocessCommunication;

use Illuminate\Support\ServiceProvider;

use Epush\Mail\App\Service\MailService;
use Epush\Auth\User\App\Service\UserService;
use Epush\Core\Admin\App\Service\AdminService;
use Epush\Core\Client\App\Service\ClientService;
use Epush\Expense\Order\App\Service\OrderService;
use Epush\Core\Message\App\Service\MessageService;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\SMS\App\Contract\EpushSMSServiceContract;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\File\App\Contract\File\FileServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Microprocess\AddUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetUsersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendMailMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\StoreFileMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\DeleteFileMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\UpdateUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\DeleteUserMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetPricelistMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetOrdersByIDMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetPricelistsMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SendSMSMessageMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientOrdersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GeneratePasswordMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchUserColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetSystemHandlersMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchSalesColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchOrderColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchClientColumnMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\UpdateClientWalletMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientsBySalesIDMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetHandlerByEndpointMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\GetClientLatestOrderMicroprocess;
use Epush\Shared\Infra\InterprocessCommunication\Microprocess\SearchPricelistColumnMicroprocess;

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
                $engine->attach(new SendSMSMessageMicroprocess(app(EpushSMSServiceContract::class)), "sms:send");

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
                $engine->attach(new GetClientLatestOrderMicroprocess(app(OrderDatabaseServiceContract::class)), "expense:order:get-client-latest-order");
                $engine->attach(new GeneratePasswordMicroprocess(app(CredentialsServiceContract::class)), "auth:credentials:generate-password");
                $engine->attach(new SendSMSMessageMicroprocess(app(EpushSMSServiceContract::class)), "sms:send");

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

                $engine->attach(new GetOrdersByIDMicroprocess(app(OrderServiceContract::class)), "expense:order:get-orders-by-id");
                $engine->attach(new SearchOrderColumnMicroprocess(app(OrderServiceContract::class)), "expense:order:search-column");
                $engine->attach(new UpdateClientWalletMicroprocess(app(ClientServiceContract::class)), "core:client:update-client-wallet");
                $engine->attach(new GetClientLatestOrderMicroprocess(app(OrderDatabaseServiceContract::class)), "expense:order:get-client-latest-order");

                return $engine;
            });


        $this->app
            ->when(MailService::class)
            ->needs(InterprocessCommunicationEngineContract::class)
            ->give(function () {

                $engine = new InterprocessCommunicationEngine();

                $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");

                return $engine;
            });


        $this->app->bind(InterprocessCommunicationEngineContract::class, function () {

            $engine = new InterprocessCommunicationEngine();

            $engine->attach(new SendMailMicroprocess(app(MailServiceContract::class)), "mail:send");
            $engine->attach(new GetHandlerByEndpointMicroprocess(app(OrchiDatabaseServiceContract::class)), "orchi:handler:get-handler-by-endpoint");

            return $engine;
        });
    }
}