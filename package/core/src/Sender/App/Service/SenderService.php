<?php

namespace Epush\Core\Sender\App\Service;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Sender\App\Contract\SenderDatabaseServiceContract;

class SenderService implements SenderServiceContract
{
    public function __construct(

        private ClientServiceContract $clientService,
        private SenderDatabaseServiceContract $senderDatabaseService

    ) {}


    public function list(int $take): array
    {
        $senders = $this->senderDatabaseService->paginateSenders($take);
        $usersID = array_unique(array_column($senders['data'], 'user_id'));
        $clients = $this->clientService->getClients($usersID);
        $senders['data'] = tableWith($senders['data'], $clients, "user_id", "user_id", "client");
        return $senders;
    }

    public function get(string $senderID): array
    {
        return $this->senderDatabaseService->getSender($senderID);
    }

    public function getClientSenders(string $userID): array
    {
        return $this->senderDatabaseService->getClientSenders($userID);
    }

    public function getSendersByID(array $sendersID): array
    {
        $senders = $this->senderDatabaseService->getSendersByID($sendersID);
        $usersID = array_unique(array_column($senders, 'user_id'));
        $clients = $this->clientService->getClients($usersID);
        $senders = tableWith($senders, $clients, "user_id", "user_id", "client");
        return $senders;
    }

    public function add(array $sender): array
    {
        return $this->senderDatabaseService->addSender($sender);
    }

    public function update(string $senderID, array $sender): array
    {
        return $this->senderDatabaseService->updateSender($senderID, $sender);
    }

    public function delete(string $senderID): bool
    {
        return $this->senderDatabaseService->deleteSender($senderID);
    }

    public function getSendersByUsersID(array $usersID, int $take = 10): array
    {
        $senders = $this->senderDatabaseService->getSendersByUsersID($usersID, $take);
        $usersID = array_unique(array_column($senders['data'], 'user_id'));
        $clients = $this->clientService->getClients($usersID);
        $senders['data'] = tableWith($senders['data'], $clients, "user_id", "user_id", "client");
        return $senders;
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case "company":
            case "company_name":
                $clients = $this->clientService->searchColumn("company_name", $value, true, 1000000000000);
                $usersID = array_unique(array_column($clients['data'], 'user_id'));
                $senders = $this->getSendersByUsersID($usersID, $take);
                break;

            default:
                $senders = $this->senderDatabaseService->searchSenderColumn($column, $value, $take);
        }

        $usersID = array_unique(array_column($senders['data'], 'user_id'));
        $clients = $this->clientService->getClients($usersID);
        $senders['data'] = tableWith($senders['data'], $clients, "user_id", "user_id", "client");
        return $senders;
    }
}