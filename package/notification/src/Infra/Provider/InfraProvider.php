<?php

namespace Epush\Notification\Infra\Provider;

use Epush\Notification\Infra\Driver\NotificationDriver;
use Epush\Notification\Infra\Driver\NotificationDriverContract;

use Epush\Notification\Infra\Database\Driver\NotificationDatabaseDriver;
use Epush\Notification\Infra\Database\Driver\NotificationDatabaseDriverContract;

use Epush\Notification\Infra\Database\Repository\NotificationTemplateRepository;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationTemplateRepositoryContract;

use Epush\Notification\Infra\Database\Repository\NotificationSendingHandlerRepository;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationSendingHandlerRepositoryContract;

use Epush\Notification\Infra\Database\Repository\UserNotificationRepository;
use Epush\Notification\Infra\Database\Repository\Contract\UserNotificationRepositoryContract;

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
        $this->app->bind(NotificationDatabaseDriverContract::class, NotificationDatabaseDriver::class);

        $this->app->bind(NotificationDriverContract::class, NotificationDriver::class);
        $this->app->bind(UserNotificationRepositoryContract::class, UserNotificationRepository::class);
        $this->app->bind(NotificationTemplateRepositoryContract::class, NotificationTemplateRepository::class);
        $this->app->bind(NotificationSendingHandlerRepositoryContract::class, NotificationSendingHandlerRepository::class);
    }
}