<?php

namespace Epush\Notification\App\Service;

use Epush\Notification\Infra\Driver\NotificationDriverContract;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\App\Contract\NotificationDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class NotificationService implements NotificationServiceContract
{
    public function __construct(

        private NotificationDriverContract $notificationDriver,
        private NotificationDatabaseServiceContract $notificationDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}

    public function listUserNotifications(): array
    {
        return $this->notificationDatabaseService->listUserNotifications();
    }

    public function getUserNotification(string $notificationID): array
    {
        return $this->notificationDatabaseService->getUserNotification($notificationID);
    }

    public function getUserNotifications(string $userID): array
    {
        return $this->notificationDatabaseService->getUserNotifications($userID);
    }

    public function getUserUnreadNotifications(string $userID): array
    {
        return $this->notificationDatabaseService->getUserUnreadNotifications($userID);
    }

    public function addUserNotification(array $notification): array
    {
        return $this->notificationDatabaseService->addUserNotification($notification);
    }

    public function updateUserNotification(string $notificationID, array $notification): array
    {
        return $this->notificationDatabaseService->updateUserNotification($notificationID, $notification);
    }

    public function updateUserNotifications(string $userID, array $notification): array
    {
        return $this->notificationDatabaseService->updateUserNotifications($userID, $notification);
    }
    
    public function deleteUserNotification(string $notificationID): bool
    {
        return $this->notificationDatabaseService->deleteUserNotification($notificationID);
    }

    public function listNotificationTemplates(): array
    {
        return $this->notificationDatabaseService->listNotificationTemplates();
    }

    public function getNotificationTemplate(string $templateID): array
    {
        return $this->notificationDatabaseService->getNotificationTemplate($templateID);
    }

    public function addNotificationTemplate(array $template): array
    {
        return $this->notificationDatabaseService->addNotificationTemplate($template);
    }

    public function updateNotificationTemplate(string $templateID, array $template): array
    {
        return $this->notificationDatabaseService->updateNotificationTemplate($templateID, $template);
    }
    
    public function deleteNotificationTemplate(string $templateID): bool
    {
        return $this->notificationDatabaseService->deleteNotificationTemplate($templateID);
    }

    public function listNotificationSendingHandlers(int $take): array
    {
        $sendingHandlers = $this->notificationDatabaseService->listNotificationSendingHandlers($take);
        $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
        $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
        $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
        return $sendingHandlers;
    }

    public function getNotificationSendingHandler(string $notificationSendingHandlerID): array
    {
        $sendingHandler = $this->notificationDatabaseService->getNotificationSendingHandler($notificationSendingHandlerID);
        $sendingHandler['handler'] = $this->communicationEngine->broadcast("orchi:handler:get-handler-by-id", $sendingHandler['id'])[0];
        return $sendingHandler;
    }

    public function addNotificationSendingHandler(array $notificationSendingHandler): array
    {
        return $this->notificationDatabaseService->addNotificationSendingHandler($notificationSendingHandler);
    }

    public function updateNotificationSendingHandler(string $notificationSendingHandlerID, array $notificationSendingHandler): array
    {
        return $this->notificationDatabaseService->updateNotificationSendingHandler($notificationSendingHandlerID, $notificationSendingHandler);
    }

    public function deleteNotificationSendingHandler(string $notificationSendingHandlerID): bool
    {
        return $this->notificationDatabaseService->deleteNotificationSendingHandler($notificationSendingHandlerID);
    }

    public function getNotificationSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->notificationDatabaseService->getNotificationSendingHandlerByHandlerID($handlerID);
    }

    public function getNotificationSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->notificationDatabaseService->getNotificationSendingHandlersByHandlersID($handlersID, $take);
    }

    public function searchNotificationSendingHandlerColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case 'endpoint':
            case 'description':
            case 'handler_name':
            case 'handler_endpoint':
            case 'handler_description':
                $column = strpos($column, "handler") !== false ? explode("_", $column)[1] : $column;
                $handlers = $this->communicationEngine->broadcast("orchi:handler:search-column", $column, $value, 1000000000000)[0];
                $handlersID = array_column($handlers['data'], 'id');
                $sendingHandlers = $this->getNotificationSendingHandlersByHandlersID($handlersID, $take);
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers['data'], 'handler_id');
                return $sendingHandlers;
                break;

            default:
                $sendingHandlers = $this->notificationDatabaseService->searchNotificationSendingHandlerColumn($column, $value, $take);
                $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
                $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
                return $sendingHandlers;
                break;
        }
    }

    public function checkAndSendNotification(array $handler, mixed $request, mixed $response): void
    {
        if ($response->getStatusCode() === 200) {

            $this->updateResponseAttributesKeys($response, $handler);
            $notificationSendingHandler = $this->getNotificationSendingHandlerByHandlerID($handler['id']);

            if (empty($notificationSendingHandler)) {
                return;
            }

            $notificationTemplate = $this->getNotificationTemplate($notificationSendingHandler['notification_template_id']);
            $templateKeys = array_merge(getMessageTemplateKeys($notificationTemplate['template']), ["user_id"]);
            $attributes = $this->getNotificationTemplateAttributesValuesFromResponse($response, $templateKeys);
            $notificationContent = $notificationTemplate['template'];

            if (! empty($templateKeys)) {
                $notificationContent = replaceTemplateKeys($notificationTemplate['template'], $attributes);
            }

            $user_id = ! empty($notificationSendingHandler['user_id']) ? $notificationSendingHandler['user_id'] : ((array_key_exists("user_id", $attributes) && ! empty($attributes['user_id'])) ? $attributes['user_id'] : null);

            if (! empty($user_id)) {
                $this->addUserNotification([
                    'user_id' => $user_id,
                    'subject' => $notificationTemplate['subject'] ?? config('notification.default_notification_subject'),
                    'content' => $notificationContent,
                    'read' => false
                ]);
                $this->notificationDriver->sendNotification($user_id, $notificationContent, $notificationTemplate['subject']);
            }
        }
    }

    private function updateResponseAttributesKeys(mixed $response, array $handler): void
    {
        if (! is_array($response->original['data'])) {
            return;
        }

        $savedResponseKeys = $this->communicationEngine->broadcast("cache:get", $handler['endpoint'])[0];
        $responseKeys = getArrayKeys(getResponseData($response->original));
        $currentResponseKeys = implode(",", array_unique(array_filter($responseKeys, fn ($key) => is_string($key) && $key !== "id")));

        if ($savedResponseKeys !== $currentResponseKeys)
        {
            $handler = $this->communicationEngine->broadcast("orchi:handler:update", $handler['id'], ['response_attributes' => $currentResponseKeys])[0];
            ! empty($handler) && $this->communicationEngine->broadcast("cache:add", $handler['endpoint'], $currentResponseKeys)[0];
        }
    }

    private function getNotificationTemplateAttributesValuesFromResponse(mixed $response, array $templateKeys)
    {
        $results = [];
        getSubArrayRecursively(getResponseData($response->original), $templateKeys, $results);
        return $results;
    }
}