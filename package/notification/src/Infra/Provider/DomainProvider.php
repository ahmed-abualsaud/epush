<?php

namespace Epush\Notification\Infra\Provider;

use Epush\Notification\Domain\DTO\UserNotificationDto;
use Epush\Notification\Domain\DTO\UserNotificationsDto;
use Epush\Notification\Domain\DTO\AddUserNotificationDto;
use Epush\Notification\Domain\DTO\UpdateUserNotificationDto;
use Epush\Notification\Domain\DTO\UpdateUserNotificationsDto;

use Epush\Notification\Domain\DTO\NotificationTemplateDto;
use Epush\Notification\Domain\DTO\AddNotificationTemplateDto;
use Epush\Notification\Domain\DTO\UpdateNotificationTemplateDto;

use Epush\Notification\Domain\DTO\NotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\AddNotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\ListNotificationSendingHandlersDto;
use Epush\Notification\Domain\DTO\SearchNotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\UpdateNotificationSendingHandlerDto;
use Illuminate\Support\ServiceProvider;

class DomainProvider extends ServiceProvider
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
        $this->app->bind(UserNotificationDto::class, function () {
            return new UserNotificationDto(['user_notification_id' => $this->app->make('request')->route('user_notification_id')]);
        });

        $this->app->bind(UserNotificationsDto::class, function () {
            return new UserNotificationsDto(['user_id' => $this->app->make('request')->route('user_id')]);
        });

        $this->app->bind(AddUserNotificationDto::class, function () {
            return new AddUserNotificationDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateUserNotificationDto::class, function () {
            return new UpdateUserNotificationDto($this->app->make('request')->route('user_notification_id'), $this->app->make('request')->all());
        });

        $this->app->bind(UpdateUserNotificationsDto::class, function () {
            return new UpdateUserNotificationsDto($this->app->make('request')->route('user_id'), $this->app->make('request')->all());
        });

        $this->app->bind(NotificationTemplateDto::class, function () {
            return new NotificationTemplateDto(['notification_template_id' => $this->app->make('request')->route('notification_template_id')]);
        });

        $this->app->bind(AddNotificationTemplateDto::class, function () {
            return new AddNotificationTemplateDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateNotificationTemplateDto::class, function () {
            return new UpdateNotificationTemplateDto($this->app->make('request')->route('notification_template_id'), $this->app->make('request')->all());
        });

        $this->app->bind(NotificationSendingHandlerDto::class, function () {
            return new NotificationSendingHandlerDto(['notification_sending_handler_id' => $this->app->make('request')->route('notification_sending_handler_id')]);
        });

        $this->app->bind(ListNotificationSendingHandlersDto::class, function () {
            return new ListNotificationSendingHandlersDto($this->app->make('request')->all());
        });

        $this->app->bind(AddNotificationSendingHandlerDto::class, function () {
            return new AddNotificationSendingHandlerDto($this->app->make('request')->all());
        });

        $this->app->bind(UpdateNotificationSendingHandlerDto::class, function () {
            return new UpdateNotificationSendingHandlerDto($this->app->make('request')->route('notification_sending_handler_id'), $this->app->make('request')->all());
        });

        $this->app->bind(SearchNotificationSendingHandlerDto::class, function () {
            return new SearchNotificationSendingHandlerDto($this->app->make('request')->all());
        });
    }
}