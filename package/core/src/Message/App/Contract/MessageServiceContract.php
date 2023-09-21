<?php

namespace Epush\Core\Message\App\Contract;

interface MessageServiceContract
{
    public function list(int $take): array;

    public function get(string $messageID): array;

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array;

    public function add(string $userID, array $message, array $recipients, array $segments): array;

    public function bulkAdd(string $userID, array $messages, array $recipients, array $segments): array;

    public function update(string $messageID, array $message): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}