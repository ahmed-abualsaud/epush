<?php

namespace Epush\Shared\App\Contract;

interface CoreServiceContract
{
    public function addClient(array $client,  array $user): array;

    public function addClientWebsites(string $clientID, array $websites): array;
}