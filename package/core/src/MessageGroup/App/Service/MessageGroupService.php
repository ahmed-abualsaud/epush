<?php

namespace Epush\Core\MessageGroup\App\Service;


use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageGroupService implements MessageGroupServiceContract
{
    public function __construct(

        private InterprocessCommunicationEngineContract $communicationEngine,
        private MessageGroupDatabaseServiceContract $messageGroupDatabaseService,
        private MessageGroupRecipientServiceContract $messageGroupRecipientService

    ) {}


    public function list(int $take): array
    {
        $groups = $this->messageGroupDatabaseService->paginateMessageGroups($take);
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", array_column($groups["data"], "user_id"))[0];
        $groups["data"] = tableWith($groups['data'], $clients, "user_id", "user_id", "client");
        return $groups;
    }

    public function get(string $messageGroupID): array
    {
        $group = $this->messageGroupDatabaseService->getMessageGroup($messageGroupID);
        $client = $this->communicationEngine->broadcast("core:client:get-client", $group["user_id"])[0];
        return tableWith([$group], [$client], "user_id", "user_id", "client")[0];
    }

    public function add(array $messageGroup, array $messageGroupRecipients): array
    {
        $group = $this->messageGroupDatabaseService->addMessageGroup($messageGroup);
        return $this->messageGroupRecipientService->add($group['id'], $messageGroupRecipients);
    }

    public function update(string $messageGroupID, array $messageGroup): array
    {
        return $this->messageGroupDatabaseService->updateMessageGroup($messageGroupID, $messageGroup);
    }

    public function delete(string $messageGroupID): bool
    {
        return $this->messageGroupDatabaseService->deleteMessageGroup($messageGroupID) && 
               $this->messageGroupRecipientService->deleteMessageGroupRecipients($messageGroupID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case "company":
            case "company_name":
                $clients = $this->communicationEngine->broadcast("core:client:search-column", "company_name", $value, true, 1000000000000)[0];
                $usersID = array_unique(array_column($clients['data'], 'user_id'));
                $groups = $this->getMessageGroupsByUsersID($usersID, $take);
                $groups['data'] = tableWith($groups['data'], $clients['data'], 'user_id', 'user_id', 'client');
                return $groups;
                break;

            default: 
                $groups = $this->messageGroupDatabaseService->searchMessageGroupColumn($column, $value, $take);
                $clients = $this->communicationEngine->broadcast("core:client:get-clients", array_column($groups["data"], "user_id"))[0];
                $groups["data"] = tableWith($groups['data'], $clients, "user_id", "user_id", "client");
                return $groups;
        }
    }

    public function getMessageGroupsByUsersID(array $usersID, int $take): array
    {
        return $this->messageGroupDatabaseService->getMessageGroupsByUsersID($usersID, $take);
    }
}