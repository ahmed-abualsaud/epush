<?php

namespace Epush\Core\Sender\App\Contract;

interface SenderServiceContract
{
    public function list(int $take): array;

    public function get(string $senderID): array;

    public function getClientSenders(string $userID): array;

    public function getSendersByID(array $sendersID): array;

    public function add(array $sender): array;

    public function update(string $senderID, array $sender): array;

    public function delete(string $senderID): bool;

    public function getSendersByUsersID(array $usersID, int $take = 10): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;

    public function initSystemSender(): void;
}