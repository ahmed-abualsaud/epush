<?php

namespace Epush\Core\Client\App\Service;

use Epush\Core\Client\App\Contract\ClientDatabaseServiceContract;
use Epush\Core\Client\Infra\Database\Driver\ClientDatabaseDriverContract;

class ClientDatabaseService implements ClientDatabaseServiceContract
{
    public function __construct(

        private ClientDatabaseDriverContract $clientDatabaseDriver

    ) {}

    public function getClient(string $userID): array
    {
        return $this->clientDatabaseDriver->clientRepository()->get($userID);
    }

    public function getClients(array $usersID, int $partnerID = null): array
    {
        return $this->clientDatabaseDriver->clientRepository()->getClients($usersID, $partnerID);
    }

    public function paginateClients(int $take, int $partnerID = null): array
    {
        return $this->clientDatabaseDriver->clientRepository()->all($take, $partnerID);
    }

    public function addClient(array $client): array
    {
        return $this->clientDatabaseDriver->clientRepository()->create($client);
    }

    public function updateClient(string $userID, array $client): array
    {
        return $this->clientDatabaseDriver->clientRepository()->update($userID, $client);
    }

    public function updateClientWallet(string $userID, float $cost, string $action): array
    {
        return $this->clientDatabaseDriver->clientRepository()->updateWallet($userID, $cost, $action);
    }

    public function deleteClient(string $userID): bool
    {
        return $this->clientDatabaseDriver->clientRepository()->delete($userID);
    }

    public function getClientsBySalesID(array $salesID): array
    {
        return $this->clientDatabaseDriver->clientRepository()->getClientsBySalesID($salesID);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientDatabaseDriver->clientRepository()->addClientWebsites($clientID, $websites);
    }

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array
    {
        return $this->clientDatabaseDriver->clientRepository()->updateClientWebsites($clientID, $newWebsites, $sync);
    }

    public function searchClientColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {
        return $this->clientDatabaseDriver->clientRepository()->searchColumn($column, $value, $take, $partnerID);
    }
}