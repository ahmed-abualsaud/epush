<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Provider;

use Epush\Core\MessageGroupRecipient\Infra\Database\Driver\MessageGroupRecipientDatabaseDriver;
use Epush\Core\MessageGroupRecipient\Infra\Database\Driver\MessageGroupRecipientDatabaseDriverContract;

use Epush\Core\MessageGroupRecipient\Infra\Database\Repository\MessageGroupRecipientRepository;
use Epush\Core\MessageGroupRecipient\Infra\Database\Repository\Contract\MessageGroupRecipientRepositoryContract;

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
        $this->app->bind(MessageGroupRecipientRepositoryContract::class, MessageGroupRecipientRepository::class);

        $this->app->bind(MessageGroupRecipientDatabaseDriverContract::class, MessageGroupRecipientDatabaseDriver::class);
    }
}