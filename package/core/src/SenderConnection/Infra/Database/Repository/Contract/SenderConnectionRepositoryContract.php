<?php

namespace Epush\Core\SenderConnection\Infra\Database\Repository\Contract;

interface SenderConnectionRepositoryContract
{
    public function all(int $take): array;

    public function get(string $senderConnectionID): array;

    public function getSenderConnections(string $senderID): array;

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array;

    public function getSendersConnectionsBySMSCsID(array $smscsID, int $take = 10): array;

    public function create(array $senderConnection): array;

    public function update(string $senderConnectionID, array $senderConnection): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}