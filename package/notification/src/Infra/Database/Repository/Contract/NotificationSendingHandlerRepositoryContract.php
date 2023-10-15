<?php

namespace Epush\Notification\Infra\Database\Repository\Contract;

interface NotificationSendingHandlerRepositoryContract
{
    public function paginate(int $take): array;

    public function get(string $notificationSendingHandlerID): array;

    public function create(array $notificationSendingHandler): array;

    public function update(string $notificationSendingHandlerID, array $notificationSendingHandler): array;

    public function delete(string $notificationSendingHandlerID): bool;

    public function getByHandlerID(string $handlerID): array;

    public function getByHandlersID(array $handlersID, int $take): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}