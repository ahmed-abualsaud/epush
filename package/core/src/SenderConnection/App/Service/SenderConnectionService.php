<?php

namespace Epush\Core\SenderConnection\App\Service;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\SMSCBinding\App\Contract\SMSCBindingServiceContract;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionDatabaseServiceContract;

class SenderConnectionService implements SenderConnectionServiceContract
{
    public function __construct(

        private ClientServiceContract $clientService,
        private SenderServiceContract $senderService,
        private SMSCBindingServiceContract $smscBindingService,
        private SenderConnectionDatabaseServiceContract $senderConnectionDatabaseService

    ) {}


    public function list(int $take): array
    {
        $sendersConnections = $this->senderConnectionDatabaseService->paginateSenderConnections($take);
        $sendersID = array_unique(array_column($sendersConnections['data'], 'sender_id'));
        $senders = $this->senderService->getSendersByID($sendersID);
        $sendersConnections['data'] = tableWith($sendersConnections['data'], $senders, "sender_id");
        return $sendersConnections;
    }

    public function get(string $senderConnectionID): array
    {
        return $this->senderConnectionDatabaseService->getSenderConnection($senderConnectionID);
    }

    public function getSenderConnections(string $senderID): array
    {
        $senderConnections = $this->senderConnectionDatabaseService->getSenderConnections($senderID);
        $sender = $this->senderService->get($senderID);
        return tableWith($senderConnections, [$sender], "sender_id");
    }

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array
    {
        return $this->senderConnectionDatabaseService->getSendersConnectionsBySendersID($sendersID, $take);
    }

    public function getSendersConnectionsBySMSCsID(array $smscsID, int $take = 10): array
    {
        return $this->senderConnectionDatabaseService->getSendersConnectionsBySMSCsID($smscsID, $take);
    }

    public function add(array $senderConnection): array
    {
        return $this->senderConnectionDatabaseService->addSenderConnection($senderConnection);
    }

    public function update(string $senderConnectionID, array $senderConnection): array
    {
        return $this->senderConnectionDatabaseService->updateSenderConnection($senderConnectionID, $senderConnection);
    }

    public function delete(string $senderConnectionID): bool
    {
        return $this->senderConnectionDatabaseService->deleteSenderConnection($senderConnectionID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case "company":
            case "company_name":
                $clients = $this->clientService->searchColumn("company_name", $value, true, 1000000000000);
                $usersID = array_unique(array_column($clients['data'], 'user_id'));
                $senders = $this->senderService->getSendersByUsersID($usersID, 1000000000000);
                $sendersID = array_unique(array_column($senders['data'], 'id'));
                $sendersConnections = $this->getSendersConnectionsBySendersID($sendersID, $take);
                $sendersConnections['data'] = tableWith($sendersConnections['data'], $senders['data'], 'sender_id');
                return $sendersConnections;
                break;

            case "sender_name":
            case "sender_approved":
                $searchColumn = ($column === "sender_name") ? "name" : "approved";
                $senders = $this->senderService->searchColumn($searchColumn, $value, 1000000000000);
                $sendersID = array_unique(array_column($senders['data'], 'id'));
                $sendersConnections = $this->getSendersConnectionsBySendersID($sendersID, $take);
                $sendersConnections['data'] = tableWith($sendersConnections['data'], $senders['data'], 'sender_id');
                return $sendersConnections;
                break;

            case "smsc_name":
            case "smsc_value":
            case "country_name":
            case "country_code":
            case "operator_name":
            case "operator_code":
                $smscs = $this->smscBindingService->searchColumn($column, $value, 1000000000000);
                $smscsID = array_unique(array_column($smscs['data'], 'id'));
                $sendersConnections = $this->getSendersConnectionsBySMSCsID($smscsID, $take);
                $sendersID = array_unique(array_column($sendersConnections['data'], 'sender_id'));
                $senders = $this->senderService->getSendersByID($sendersID);
                $sendersConnections['data'] = tableWith($sendersConnections['data'], $senders, 'sender_id');
                return $sendersConnections;
                break;

            default:
                $sendersConnections = $this->senderConnectionDatabaseService->searchSenderConnectionColumn($column, $value, $take);
                $sendersID = array_unique(array_column($sendersConnections['data'], 'sender_id'));
                $senders = $this->senderService->getSendersByID($sendersID);
                $sendersConnections['data'] = tableWith($sendersConnections['data'], $senders, "sender_id");
                return $sendersConnections;
        }
    }
}