<?php

namespace Epush\Core\MessageGroup\App\Contract;

interface MessageGroupServiceContract
{
    public function list(int $take): array;

    public function get(string $messageGroupID): array;

    public function add(array $messageGroup, array $messageGroupRecipients): array;

    public function update(string $messageGroupID, array $messageGroup): array;

    public function delete(string $messageGroupID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}