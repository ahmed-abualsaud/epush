<?php

namespace Epush\Core\Client\App\Service;


use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Client\App\Contract\ClientDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class ClientService implements ClientServiceContract
{
    public function __construct(

        private ClientDatabaseServiceContract $clientDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $clients = $this->clientDatabaseService->paginateClients($take, $partnerID);
        $usersID = array_column($clients['data'], 'user_id');
        $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
        $clients['data'] = tableWith($clients['data'], $users, "user_id");
        return $clients;
    }

    public function get(string $userID): array
    {
        $client = $this->clientDatabaseService->getClient($userID);
        $user = $this->communicationEngine->broadcast("auth:user:get-user", $userID)[0];
        $result =  array_replace_recursive($user, $client);
        $result['id'] = $userID;
        $result['client_id'] = $client['id'] ?? null;
        $result['stats'] = $this->communicationEngine->broadcast("core:message:get-client-messages-stats", $userID)[0];
        return $result;
    }


    public function add(array $client, array $user): array
    {
        array_key_exists("websites", $client) && ! empty($client['websites']) && $websites = json_decode($client['websites'], true);
        unset($client['websites']);

        $user = $this->communicationEngine->broadcast("auth:user:add-user", $user, 'client')[0];
        $client['user_id'] = $user['id'];
        $client = $this->clientDatabaseService->addClient($client);
        ! empty($websites) && $this->clientDatabaseService->addClientWebsites($client['id'], $websites);

        $result =  array_replace_recursive($user, $client);
        $result['id'] = $client['user_id'];
        $result['client_id'] = $client['id'];
        return $result;
    }

    public function update(string $userID, array $client, array $user): array
    {
        $sync_websites = array_key_exists("sync_websites", $client) && $client['sync_websites'];
        array_key_exists("websites", $client) && ! empty($client['websites']) && $websites = json_decode($client['websites'], true);
        isset($websites) && $this->clientDatabaseService->updateClientWebsites($this->get($userID)['client_id'], $websites, $sync_websites);
        unset($client['websites'], $client['sync_websites']);

        $user = $this->communicationEngine->broadcast("auth:user:update-user", $userID, $user)[0];
        $client = $this->clientDatabaseService->updateClient($userID, $client);
        return tableWith([$client], [$user], "user_id")[0];
    }

    public function updateWallet(string $userID, float $cost, string $action): array
    {
        return $this->clientDatabaseService->updateClientWallet($userID, $cost, $action);
    }

    public function delete(string $userID): bool
    {
        return $this->clientDatabaseService->deleteClient($userID) && $this->communicationEngine->broadcast("auth:user:delete-user", $userID)[0];
    }

    public function getClients(array $usersID, int $partnerID = null): array
    {
        return $this->clientDatabaseService->getClients($usersID, $partnerID);
    }

    public function getClientsBySalesID(array $salesID): array
    {
        return $this->clientDatabaseService->getClientsBySalesID($salesID);
    }

    public function getClientOrders(string $userID): array
    {
        return $this->communicationEngine->broadcast("expense:order:get-client-orders", $userID)[0];
    }

    public function getClientSenders(string $userID): array
    {
        return $this->communicationEngine->broadcast("core:sender:get-client-senders", $userID)[0];
    }

    public function getClientMessages(string $userID, int $take = null): array
    {
        return $this->communicationEngine->broadcast("core:message:get-client-messages", $userID, $take)[0];
    }

    public function getClientMessageGroups(string $userID): array
    {
        return $this->communicationEngine->broadcast("core:message-group:get-client-message-groups", $userID)[0];
    }

    public function getClientLatestOrder(string $userID): array
    {
        return $this->communicationEngine->broadcast("expense:order:get-client-latest-order", $userID)[0];
    }

    public function getClientIPWhitelist(string $userID): array
    {
        return $this->communicationEngine->broadcast("core:ipwhitelist:get-client-ipwhitelist", $userID)[0];
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientDatabaseService->addClientWebsites($clientID, $websites);
    }

    public function searchColumn(string $column, string $value, bool $searchClient = true, int $take = 10, int $partnerID = null): array
    {
        if ($searchClient) {
            $clients = $this->clientDatabaseService->searchClientColumn($column, $value, $take, $partnerID);
            $usersID = array_column($clients['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
            $clients['data'] = tableWith($clients['data'], $users, "user_id");
            return $clients;
        } else {
            $clients = $this->clientDatabaseService->paginateClients(1000000000000, $partnerID);
            $usersID = array_column($clients['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:search-column", $column, $value, $take, $usersID, $partnerID)[0];
            $usersID = array_column($users['data'], 'id');
            $clients = $this->clientDatabaseService->getClients($usersID);
            $users['data'] = tableWith($clients, $users['data'], "user_id");
            return $users;
        }

    }
}