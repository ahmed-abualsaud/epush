<?php

namespace Epush\Core\App\Contract;

interface CoreDatabaseServiceContract
{
    public function getClient(string $userID): array;

    public function addClient(array $client): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}