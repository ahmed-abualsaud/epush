<?php

namespace Epush\Core\MessageRecipient\App\Contract;

interface MessageRecipientDatabaseServiceContract
{
    public function addMessageRecipients(string $messageID, array $messageGroupRecipientIDs, $status = 'Initialized'): array;

    public function paginateMessageRecipients(int $take): array;

    public function updateMessageRecipients(string $messageID, array $data): array;

    public function deleteMessageRecipients(string $messageID): bool;

    public function searchMessageRecipientColumn(string $column, string $value, int $take = 10): array;
}