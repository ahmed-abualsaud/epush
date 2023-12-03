<?php

namespace Epush\Core\Message\Infra\Database\Repository\Contract;

interface MessageRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageID): array;

    public function getClientMessages(string $userID): array;

    public function getMessagesByUsersID(array $usersID, int $take = 10): array;

    public function getMessagesByOrdersID(array $ordersID, int $take = 10): array;

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array;

    public function create(array $message): array;

    public function insert(array $messages): array;

    public function update(string $messageID, array $message): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getReadyToSendScheduledMessages(): array;
}