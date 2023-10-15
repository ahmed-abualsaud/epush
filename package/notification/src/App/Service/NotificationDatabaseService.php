<?php

namespace Epush\Notification\App\Service;

use Epush\Notification\App\Contract\NotificationDatabaseServiceContract;
use Epush\Notification\Infra\Database\Driver\NotificationDatabaseDriverContract;

class NotificationDatabaseService implements NotificationDatabaseServiceContract
{
    public function __construct(

        private NotificationDatabaseDriverContract $notificationDatabaseDriver

    ) {}

    public function listUserNotifications(): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->all();
    }

    public function getUserNotification(string $notificationID): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->get($notificationID);
    }

    public function getUserNotifications(string $userID): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->getUserNotifications($userID);
    }

    public function getUserUnreadNotifications(string $userID): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->getUserUnreadNotifications($userID);
    }

    public function addUserNotification(array $notification): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->create($notification);
    }

    public function updateUserNotification(string $notificationID, array $notification): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->update($notificationID, $notification);
    }

    public function updateUserNotifications(string $userID, array $notification): array
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->updateUserNotifications($userID, $notification);
    }
    
    public function deleteUserNotification(string $notificationID): bool
    {
        return $this->notificationDatabaseDriver->userNotificationRepository()->delete($notificationID);
    }

    public function listNotificationTemplates(): array
    {
        return $this->notificationDatabaseDriver->notificationTemplateRepository()->all();
    }

    public function getNotificationTemplate(string $templateID): array
    {
        return $this->notificationDatabaseDriver->notificationTemplateRepository()->get($templateID);
    }

    public function addNotificationTemplate(array $template): array
    {
        return $this->notificationDatabaseDriver->notificationTemplateRepository()->create($template);
    }

    public function updateNotificationTemplate(string $templateID, array $template): array
    {
        return $this->notificationDatabaseDriver->notificationTemplateRepository()->update($templateID, $template);
    }
    
    public function deleteNotificationTemplate(string $templateID): bool
    {
        return $this->notificationDatabaseDriver->notificationTemplateRepository()->delete($templateID);
    }

    public function listNotificationSendingHandlers(int $take): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->paginate($take);
    }

    public function getNotificationSendingHandler(string $notificationSendingHandlerID): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->get($notificationSendingHandlerID);
    }

    public function addNotificationSendingHandler(array $notificationSendingHandler): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->create($notificationSendingHandler);
    }

    public function updateNotificationSendingHandler(string $notificationSendingHandlerID, array $notificationSendingHandler): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->update($notificationSendingHandlerID, $notificationSendingHandler);
    }

    public function deleteNotificationSendingHandler(string $notificationSendingHandlerID): bool
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->delete($notificationSendingHandlerID);
    }

    public function getNotificationSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->getByHandlerID($handlerID);
    }

    public function getNotificationSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->getByHandlersID($handlersID, $take);
    }

    public function searchNotificationSendingHandlerColumn(string $column, string $value, int $take = 10): array
    {
        return $this->notificationDatabaseDriver->notificationSendingHandlerRepository()->searchColumn($column, $value, $take);
    }
}