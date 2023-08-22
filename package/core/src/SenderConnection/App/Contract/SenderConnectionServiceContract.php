<?php

namespace Epush\Core\SenderConnection\App\Contract;

interface SenderConnectionServiceContract
{
    public function list(int $take): array;

    public function get(string $senderConnectionID): array;

    public function getSenderConnections(string $senderID): array;

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array;

    public function add(array $senderConnection): array;

    public function update(string $senderConnectionID, array $senderConnection): array;

    public function delete(string $senderConnectionID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}