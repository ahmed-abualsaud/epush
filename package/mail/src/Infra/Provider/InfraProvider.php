<?php

namespace Epush\Mail\Infra\Provider;

use Epush\Mail\Infra\Database\Driver\MailDatabaseDriver;
use Epush\Mail\Infra\Database\Driver\MailDatabaseDriverContract;

use Epush\Mail\Infra\Database\Repository\MailTemplateRepository;
use Epush\Mail\Infra\Database\Repository\Contract\MailTemplateRepositoryContract;

use Epush\Mail\Infra\Database\Repository\MailSendingHandlerRepository;
use Epush\Mail\Infra\Database\Repository\Contract\MailSendingHandlerRepositoryContract;

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
        $this->app->bind(MailDatabaseDriverContract::class, MailDatabaseDriver::class);

        $this->app->bind(MailTemplateRepositoryContract::class, MailTemplateRepository::class);
        $this->app->bind(MailSendingHandlerRepositoryContract::class, MailSendingHandlerRepository::class);
    }
}