<?php

namespace Epush\Core\SenderConnection\App\Contract;

interface SenderConnectionDatabaseServiceContract
{
    public function getSenderConnection(string $senderConnectionID): array;

    public function getSenderConnections(string $senderID): array;

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array;

    public function getSendersConnectionsBySMSCsID(array $smscsID, int $take = 10): array;

    public function addSenderConnection(array $senderConnection): array;

    public function deleteSenderConnection(string $senderConnectionID): bool;

    public function updateSenderConnection(string $senderConnectionID, array $senderConnection): array;

    public function paginateSenderConnections(int $take): array;

    public function searchSenderConnectionColumn(string $column, string $value, int $take = 10): array;
}