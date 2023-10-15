<?php

namespace Epush\SMS\Infra\Provider;

use Epush\SMS\Infra\Driver\SMSDriver;
use Epush\SMS\Infra\Driver\SMSDriverContract;

use Epush\SMS\Infra\Database\Driver\SMSDatabaseDriver;
use Epush\SMS\Infra\Database\Driver\SMSDatabaseDriverContract;

use Epush\SMS\Infra\Database\Repository\SMSTemplateRepository;
use Epush\SMS\Infra\Database\Repository\Contract\SMSTemplateRepositoryContract;

use Epush\SMS\Infra\Database\Repository\SMSSendingHandlerRepository;
use Epush\SMS\Infra\Database\Repository\Contract\SMSSendingHandlerRepositoryContract;

use Illuminate\Support\ServiceProvider;


class InfraProvider extends ServiceProvider
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
        $this->app->bind(SMSDatabaseDriverContract::class, SMSDatabaseDriver::class);

        $this->app->bind(SMSDriverContract::class, SMSDriver::class);
        $this->app->bind(SMSTemplateRepositoryContract::class, SMSTemplateRepository::class);
        $this->app->bind(SMSSendingHandlerRepositoryContract::class, SMSSendingHandlerRepository::class);
    }
}