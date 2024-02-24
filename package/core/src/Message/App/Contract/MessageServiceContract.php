<?php

namespace Epush\Core\Message\App\Contract;

interface MessageServiceContract
{
    public function list(int $take): array;

    public function get(string $messageID): array;

    public function getMessageRecipients(string $messageID, int $take = 10): array;

    public function getMessagesByUsersID(array $usersID, int $take = 10): array;

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array;

    public function add(string $userID, array $messageGroupRecipients, array $message, array $segments): array;

    public function bulkAdd(string $userID, array $messageGroupRecipients, array $message, array $segments): array;

    public function update(string $messageID, array $message): array;

    public function sendScheduledMessages(): void;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function oldApiSendBulk(array $inputs): mixed;

    public function oldApiCheckBalance(array $inputs): mixed;

    public function sendMessage(array $message): mixed;

    public function getClientMessagesStats(string $userID): array;
}