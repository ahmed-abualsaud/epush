<?php

namespace Epush\Notification\Infra\Database\Driver;

use Epush\Notification\Infra\Database\Repository\Contract\UserNotificationRepositoryContract;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationTemplateRepositoryContract;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationSendingHandlerRepositoryContract;

interface NotificationDatabaseDriverContract
{
    public function userNotificationRepository(): UserNotificationRepositoryContract;

    public function notificationTemplateRepository(): NotificationTemplateRepositoryContract;

    public function notificationSendingHandlerRepository(): NotificationSendingHandlerRepositoryContract;
}