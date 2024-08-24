<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Database\Repository\Contract;

interface MessageGroupRecipientRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageGroupRecipientID): array;

    public function insert(string $groupID, array $messageGroupRecipients): int;

    public function insertAndFetch(string $groupID, array $messageGroupRecipients): array;

    public function update(string $messageGroupRecipientID, array $messageGroupRecipient): array;

    public function delete(string $id): bool;

    public function deleteGroupRecipients(string $groupID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function getMessageRecipients(string $messageID, int $take): array;

    public function getMessageGroupRecipients(string $messageGroupID, int $take): array;

}