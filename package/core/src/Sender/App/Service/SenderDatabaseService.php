<?php

namespace Epush\Core\Sender\App\Service;

use Epush\Core\Sender\App\Contract\SenderDatabaseServiceContract;
use Epush\Core\Sender\Infra\Database\Driver\SenderDatabaseDriverContract;

class SenderDatabaseService implements SenderDatabaseServiceContract
{
    public function __construct(

        private SenderDatabaseDriverContract $senderDatabaseDriver

    ) {}

    public function getSender(string $senderID): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->get($senderID);
    }

    public function getClientSenders(string $userID): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->getClientSenders($userID);

    }

    public function getSendersByID(array $sendersID): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->getSendersByID($sendersID);
    }

    public function paginateSenders(int $take): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->all($take);
    }

    public function addSender(array $sender): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->create($sender);
    }

    public function updateSender(string $senderID, array $sender): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->update($senderID, $sender);
    }

    public function deleteSender(string $senderID): bool
    {
        return $this->senderDatabaseDriver->SenderRepository()->delete($senderID);
    }

    public function getSendersByUsersID(array $usersID, int $take = 10): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->getSendersByUsersID($usersID, $take);
    }

    public function searchSenderColumn(string $column, string $value, int $take = 10): array
    {
        return $this->senderDatabaseDriver->SenderRepository()->searchColumn($column, $value, $take);
    }
}