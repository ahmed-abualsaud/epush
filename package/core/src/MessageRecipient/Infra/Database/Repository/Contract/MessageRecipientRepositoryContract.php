<?php

namespace Epush\Core\MessageRecipient\Infra\Database\Repository\Contract;

interface MessageRecipientRepositoryContract
{
    public function all(int $take): array;

    public function insert(string $messageID, array $messageRecipients): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}