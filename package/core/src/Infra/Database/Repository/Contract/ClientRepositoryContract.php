<?php

namespace Epush\Core\Infra\Database\Repository\Contract;

interface ClientRepositoryContract
{
    public function get(string $clientID): array;

    public function add(array $client): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}