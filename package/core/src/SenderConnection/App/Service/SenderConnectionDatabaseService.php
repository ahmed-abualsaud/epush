<?php

namespace Epush\Core\SenderConnection\App\Service;

use Epush\Core\SenderConnection\App\Contract\SenderConnectionDatabaseServiceContract;
use Epush\Core\SenderConnection\Infra\Database\Driver\SenderConnectionDatabaseDriverContract;

class SenderConnectionDatabaseService implements SenderConnectionDatabaseServiceContract
{
    public function __construct(

        private SenderConnectionDatabaseDriverContract $senderConnectionDatabaseDriver

    ) {}

    public function getSenderConnection(string $senderConnectionID): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->get($senderConnectionID);
    }

    public function getSenderConnections(string $senderID): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->getSenderConnections($senderID);
    }

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->getSendersConnectionsBySendersID($sendersID);
    }

    public function getSendersConnectionsBySMSCsID(array $smscsID, int $take = 10): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->getSendersConnectionsBySMSCsID($smscsID);
    }

    public function paginateSenderConnections(int $take): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->all($take);
    }

    public function addSenderConnection(array $senderConnection): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->create($senderConnection);
    }

    public function updateSenderConnection(string $senderConnectionID, array $senderConnection): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->update($senderConnectionID, $senderConnection);
    }

    public function deleteSenderConnection(string $senderConnectionID): bool
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->delete($senderConnectionID);
    }

    public function searchSenderConnectionColumn(string $column, string $value, int $take = 10): array
    {
        return $this->senderConnectionDatabaseDriver->SenderConnectionRepository()->searchColumn($column, $value, $take);
    }
}