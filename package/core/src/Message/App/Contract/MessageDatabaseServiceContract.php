<?php

namespace Epush\Core\Message\App\Contract;

interface MessageDatabaseServiceContract
{
    public function getMessage(string $messageID): array;

    public function getClientMessages(string $userID): array;

    public function getMessagesByUsersID(array $usersID, int $take = 10): array;

    public function getMessagesByOrdersID(array $ordersID, int $take = 10): array;

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array;

    public function addMessage(array $message): array;

    public function bulkAddMessage(array $messages): array;

    public function deleteMessage(string $messageID): bool;

    public function updateMessage(string $messageID, array $message): array;

    public function paginateMessages(int $take): array;

    public function searchMessageColumn(string $column, string $value, int $take = 10): array;

    public function getReadyToSendScheduledMessages(): array;
}