<?php

namespace Epush\Core\MessageRecipient\Infra\Provider;

use Epush\Core\MessageRecipient\Infra\Database\Driver\MessageRecipientDatabaseDriver;
use Epush\Core\MessageRecipient\Infra\Database\Driver\MessageRecipientDatabaseDriverContract;

use Epush\Core\MessageRecipient\Infra\Database\Repository\MessageRecipientRepository;
use Epush\Core\MessageRecipient\Infra\Database\Repository\Contract\MessageRecipientRepositoryContract;

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
        $this->app->bind(MessageRecipientRepositoryContract::class, MessageRecipientRepository::class);

        $this->app->bind(MessageRecipientDatabaseDriverContract::class, MessageRecipientDatabaseDriver::class);
    }
}