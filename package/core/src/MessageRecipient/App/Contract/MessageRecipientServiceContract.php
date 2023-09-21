<?php

namespace Epush\Core\MessageRecipient\App\Contract;

interface MessageRecipientServiceContract
{
    public function list(int $take): array;

    public function add(string $messageID, array $messageRecipients): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}