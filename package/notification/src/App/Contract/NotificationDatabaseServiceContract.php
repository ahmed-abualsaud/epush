<?php

namespace Epush\Notification\App\Contract;

interface NotificationDatabaseServiceContract
{
    public function listUserNotifications(): array;

    public function getUserNotification(string $notificationID): array;

    public function getUserNotifications(string $userID): array;

    public function getUserUnreadNotifications(string $userID): array;

    public function addUserNotification(array $notification): array;

    public function updateUserNotification(string $notificationID, array $notification): array;

    public function updateUserNotifications(string $userID, array $notification): array;
    
    public function deleteUserNotification(string $notificationID): bool;

    public function listNotificationTemplates(): array;

    public function getNotificationTemplate(string $templateID): array;

    public function addNotificationTemplate(array $template): array;

    public function updateNotificationTemplate(string $templateID, array $template): array;
    
    public function deleteNotificationTemplate(string $templateID): bool;

    public function listNotificationSendingHandlers(int $take): array;

    public function getNotificationSendingHandler(string $notificationSendingHandlerID): array;

    public function addNotificationSendingHandler(array $notificationSendingHandler): array;

    public function updateNotificationSendingHandler(string $notificationSendingHandlerID, array $notificationSendingHandler): array;
    
    public function deleteNotificationSendingHandler(string $notificationSendingHandlerID): bool;

    public function getNotificationSendingHandlerByHandlerID(string $handlerID): array;

    public function getNotificationSendingHandlersByHandlersID(array $handlersID, int $take): array;

    public function searchNotificationSendingHandlerColumn(string $column, string $value, int $take = 10): array;
}