<?php

namespace Epush\Core\App\Contract;

interface ClientServiceContract
{
    public function get(string $clientID): array;

    public function addClient(array $client): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}