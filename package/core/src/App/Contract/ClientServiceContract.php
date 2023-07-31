<?php

namespace Epush\Core\App\Contract;

interface ClientServiceContract
{
    public function get(string $userID): array;

    public function add(array $client, array $user): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}