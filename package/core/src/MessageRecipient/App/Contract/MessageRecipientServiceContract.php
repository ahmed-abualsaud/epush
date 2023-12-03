<?php

namespace Epush\Core\MessageRecipient\App\Contract;

interface MessageRecipientServiceContract
{
    public function list(int $take): array;

    public function add(string $messageID, array $messageGroupRecipientIDs, $status = 'Initialized'): array;

    public function update(string $messageID, array $data): array;

    public function delete(string $messageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}