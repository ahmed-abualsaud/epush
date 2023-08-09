<?php

namespace Epush\Core\Client\App\Service;


use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Client\App\Contract\ClientDatabaseServiceContract;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Shared\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\MailServiceContract;

class ClientService implements ClientServiceContract
{
    public function __construct(

        private SMSServiceContract $smsService,
        private MailServiceContract $mailService,
        private FileServiceContract $fileService,
        private AuthServiceContract $authService,
        private ClientDatabaseServiceContract $clientDatabaseService

    ) {}


    public function list(int $take): array
    {
        $clients = $this->clientDatabaseService->paginateClients($take);
        $usersID = array_column($clients['data'], 'user_id');
        $users = $this->authService->getUsers($usersID);
        $clients['data'] = innerJoinTableArraysOnColumns($users, $clients['data'], "id", "user_id");
        return $clients;
    }

    public function get(string $userID): array
    {
        $client = $this->clientDatabaseService->getClient($userID);
        $user = $this->authService->getUser($userID);
        $result =  array_replace_recursive($user, $client);
        $result['id'] = $userID;
        $result['client_id'] = $client['id'] ?? null;
        return $result;
    }


    public function add(array $client, array $user): array
    {
        array_key_exists("websites", $client) && ! empty($client['websites']) && $websites = json_decode($client['websites'], true);
        unset($client['websites']);

        $user = $this->authService->addUser($user, 'client');
        $password = $this->authService->generatePassword($user['id']);

        $client['user_id'] = $user['id'];
        $client = $this->clientDatabaseService->addClient($client);
        ! empty($websites) && $this->clientDatabaseService->addClientWebsites($client['id'], $websites);

        $this->smsService->sendMessage($user['phone'], 'Your password is: '.$password);
        $this->mailService->sendClientAddedMail($user['email'], $user);

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

        $user = $this->authService->updateUser($userID, $user);
        $client = $this->clientDatabaseService->updateClient($userID, $client);
        return innerJoinTableArraysOnColumns([$user], [$client], "id", "user_id")[0];
    }

    public function delete(string $userID): bool
    {
        return $this->clientDatabaseService->deleteClient($userID) && $this->authService->deleteUser($userID);
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->clientDatabaseService->addClientWebsites($clientID, $websites);
    }

    public function searchColumn(string $column, string $value, bool $searchClient = true, int $take = 10): array
    {
        if ($searchClient) {
            $clients = $this->clientDatabaseService->searchClientColumn($column, $value, $take);
            $usersID = array_column($clients['data'], 'user_id');
            $users = $this->authService->getUsers($usersID);
            $clients['data'] = innerJoinTableArraysOnColumns($users, $clients['data'], "id", "user_id");
            return $clients;
        } else {
            $clients = $this->clientDatabaseService->paginateClients(1000000000000);
            $usersID = array_column($clients['data'], 'user_id');
            $users = $this->authService->searchUserColumn($column, $value, $take, $usersID);
            $usersID = array_column($users['data'], 'id');
            $clients = $this->clientDatabaseService->getClients($usersID);
            $users['data'] = innerJoinTableArraysOnColumns($users['data'], $clients, "id", "user_id");
            return $users;
        }

    }
}