<?php

namespace Epush\Core\MessageGroupRecipient\App\Contract;

interface MessageGroupRecipientServiceContract
{
    public function list(int $take): array;

    public function get(string $messageGroupRecipientID): array;

    public function add(string $groupID, array $messageGroupRecipients): array;

    public function update(string $messageGroupRecipientID, array $messageGroupRecipient): array;

    public function delete(string $messageGroupRecipientID): bool;

    public function deleteMessageGroupRecipients(string $groupID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}