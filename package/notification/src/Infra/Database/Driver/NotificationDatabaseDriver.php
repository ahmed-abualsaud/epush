<?php

namespace Epush\Notification\Infra\Database\Driver;

use Epush\Notification\Infra\Database\Repository\Contract\UserNotificationRepositoryContract;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationTemplateRepositoryContract;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationSendingHandlerRepositoryContract;

class NotificationDatabaseDriver implements NotificationDatabaseDriverContract
{
    public function __construct(

        private UserNotificationRepositoryContract $userNotificationRepository,
        private NotificationTemplateRepositoryContract $notificationTemplateRepository,
        private NotificationSendingHandlerRepositoryContract $notificationSendingHandlerRepository

    ) {}

    public function userNotificationRepository(): UserNotificationRepositoryContract
    {
        return $this->userNotificationRepository;
    }

    public function notificationTemplateRepository(): NotificationTemplateRepositoryContract
    {
        return $this->notificationTemplateRepository;
    }

    public function notificationSendingHandlerRepository(): NotificationSendingHandlerRepositoryContract
    {
        return $this->notificationSendingHandlerRepository;
    }
}