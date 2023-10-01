<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Provider;

use Epush\Core\MessageGroupRecipient\App\Service\MessageGroupRecipientService;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;

use Epush\Core\MessageGroupRecipient\App\Service\MessageGroupRecipientDatabaseService;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientDatabaseServiceContract;

use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider
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
        $this->app->bind(MessageGroupRecipientServiceContract::class, MessageGroupRecipientService::class);
        $this->app->bind(MessageGroupRecipientDatabaseServiceContract::class, MessageGroupRecipientDatabaseService::class);
    }
}