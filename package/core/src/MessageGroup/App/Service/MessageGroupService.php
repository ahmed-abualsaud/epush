<?php

namespace Epush\Core\MessageGroup\App\Service;


use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;
use Epush\Core\MessageGroup\Infra\Driver\MessageGroupDriverContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageGroupService implements MessageGroupServiceContract
{
    public function __construct(

        private MessageGroupDriverContract $messageGroupDriver,
        private InterprocessCommunicationEngineContract $communicationEngine,
        private MessageGroupDatabaseServiceContract $messageGroupDatabaseService,
        private MessageGroupRecipientServiceContract $messageGroupRecipientService

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $groups = $this->messageGroupDatabaseService->paginateMessageGroups($take);
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", array_column($groups["data"], "user_id"), $partnerID)[0];
        $groups["data"] = tableWith($groups['data'], $clients, "user_id", "user_id", "client");
        if (! empty($partnerID)) {
            $groups['data'] = array_filter($groups['data'], function ($group) {
                return ! empty($group['client']);
            });
        }
        return $groups;
    }

    public function get(string $messageGroupID): array
    {
        $group = $this->messageGroupDatabaseService->getMessageGroup($messageGroupID);
        $client = $this->communicationEngine->broadcast("core:client:get-client", $group["user_id"])[0];
        return tableWith([$group], [$client], "user_id", "user_id", "client")[0];
    }

    public function add(array $messageGroup, array $messageGroupRecipients, string $messageID = null, string $status = null): array
    {
        $group = $this->messageGroupDatabaseService->addMessageGroup($messageGroup);
        $this->messageGroupDriver->insertRecipients($group['id'], $messageGroupRecipients, $messageID, $status);
        return $group;
    }

    public function addAndGetRecipients(array $messageGroup, array $messageGroupRecipients): array
    {
        $group = $this->messageGroupDatabaseService->addMessageGroup($messageGroup);
        return $this->messageGroupRecipientService->addAndGetRecipients($group['id'], $messageGroupRecipients);
    }

    public function addNow(array $messageGroup, array $messageGroupRecipients): array
    {
        $group = $this->messageGroupDatabaseService->addMessageGroup($messageGroup);
        $count = $this->messageGroupRecipientService->add($group['id'], $messageGroupRecipients);
        $this->update($group['id'], ['number_of_recipients' => $count['count']]);
        return $group;
    }

    public function update(string $messageGroupID, array $messageGroup): array
    {
        return $this->messageGroupDatabaseService->updateMessageGroup($messageGroupID, $messageGroup);
    }

    public function delete(string $messageGroupID): bool
    {
        $groupDeleted = $this->messageGroupDatabaseService->deleteMessageGroup($messageGroupID) ;
        $recipientsDeleted = $this->messageGroupRecipientService->deleteMessageGroupRecipients($messageGroupID);
        return $groupDeleted && $recipientsDeleted;
    }

    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {
        switch ($column) {
            case "company":
            case "company_name":
                $clients = $this->communicationEngine->broadcast("core:client:search-column", "company_name", $value, true, 1000000000000, $partnerID)[0];
                $usersID = array_unique(array_column($clients['data'], 'user_id'));
                $groups = $this->getMessageGroupsByUsersID($usersID, $take);
                $groups['data'] = tableWith($groups['data'], $clients['data'], 'user_id', 'user_id', 'client');
                if (! empty($partnerID)) {
                    $groups['data'] = array_filter($groups['data'], function ($group) {
                        return ! empty($group['client']);
                    });
                }
                return $groups;
                break;

            default: 
                $groups = $this->messageGroupDatabaseService->searchMessageGroupColumn($column, $value, $take);
                $clients = $this->communicationEngine->broadcast("core:client:get-clients", array_column($groups["data"], "user_id"), $partnerID)[0];
                $groups["data"] = tableWith($groups['data'], $clients, "user_id", "user_id", "client");
                $groups['data'] = array_filter($groups['data'], function ($group) {
                    return ! empty($group['client']);
                });
                return $groups;
        }
    }

    public function getMessageGroupsByUsersID(array $usersID, int $take): array
    {
        return $this->messageGroupDatabaseService->getMessageGroupsByUsersID($usersID, $take);
    }

    public function getMessageGroupRecipients(string $messageGroupID, int $take = 10): array
    {
        return $this->messageGroupRecipientService->getMessageGroupRecipients($messageGroupID, $take);
    }
}