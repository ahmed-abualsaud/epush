<?php

namespace Epush\Core\Sender\App\Contract;

interface SenderDatabaseServiceContract
{
    public function getSender(string $senderID): array;

    public function getClientSenders(string $userID): array;

    public function getSendersByID(array $sendersID): array;

    public function addSender(array $sender): array;

    public function deleteSender(string $senderID): bool;

    public function updateSender(string $senderID, array $sender): array;

    public function paginateSenders(int $take): array;

    public function getSendersByUsersID(array $usersID, int $take = 10): array;

    public function searchSenderColumn(string $column, string $value, int $take = 10): array;
}