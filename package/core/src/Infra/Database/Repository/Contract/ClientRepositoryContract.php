<?php

namespace Epush\Core\Infra\Database\Repository\Contract;

interface ClientRepositoryContract
{
    public function get(string $userID): array;

    public function create(array $client): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}