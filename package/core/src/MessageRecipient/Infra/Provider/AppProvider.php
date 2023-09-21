<?php

namespace Epush\Core\MessageRecipient\Infra\Provider;

use Epush\Core\MessageRecipient\App\Service\MessageRecipientService;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;

use Epush\Core\MessageRecipient\App\Service\MessageRecipientDatabaseService;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientDatabaseServiceContract;

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
        $this->app->bind(MessageRecipientServiceContract::class, MessageRecipientService::class);
        $this->app->bind(MessageRecipientDatabaseServiceContract::class, MessageRecipientDatabaseService::class);
    }
}