<?php

namespace Epush\Core\MessageGroupRecipient\App\Contract;

interface MessageGroupRecipientDatabaseServiceContract
{
    public function getMessageGroupRecipient(string $messageGroupRecipientID): array;

    public function addMessageGroupRecipients(string $groupID, array $messageGroupRecipients): array;

    public function deleteMessageGroupRecipient(string $messageGroupRecipientID): bool;

    public function deleteMessageGroupRecipients(string $groupID): bool;

    public function updateMessageGroupRecipient(string $messageGroupRecipientID, array $messageGroupRecipient): array;

    public function paginateMessageGroupRecipients(int $take): array;

    public function searchMessageGroupRecipientColumn(string $column, string $value, int $take = 10): array;

    public function getMessageRecipients(string $messageID, int $take): array;

    public function getMessageGroupRecipients(string $messageGroupID, int $take): array;

}