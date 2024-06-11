<?php

namespace Epush\Core\MessageGroupRecipient\App\Service;


use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageGroupRecipientService implements MessageGroupRecipientServiceContract
{
    public function __construct(

        private InterprocessCommunicationEngineContract $communicationEngine,

        private MessageGroupRecipientDatabaseServiceContract $messageGroupRecipientDatabaseService

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $groupRecipients = $this->messageGroupRecipientDatabaseService->paginateMessageGroupRecipients($take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $groupRecipients['data'] = array_values(array_filter($groupRecipients['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message_group']['user_id']) && in_array($recipient['message_group']['user_id'], $usersIDs);
            }));
        }

        return $groupRecipients;
    }

    public function get(string $messageGroupRecipientID): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageGroupRecipient($messageGroupRecipientID);
    }

    public function add(string $groupID, array $messageGroupRecipients): array
    {
        return $this->messageGroupRecipientDatabaseService->addMessageGroupRecipients($groupID, $messageGroupRecipients);
    }

    public function update(string $messageGroupRecipientID, array $messageGroupRecipient): array
    {
        return $this->messageGroupRecipientDatabaseService->updateMessageGroupRecipient($messageGroupRecipientID, $messageGroupRecipient);
    }

    public function delete(string $messageGroupRecipientID): bool
    {
        return $this->messageGroupRecipientDatabaseService->deleteMessageGroupRecipient($messageGroupRecipientID);
    }

    public function deleteMessageGroupRecipients(string $groupID): bool
    {
        return $this->messageGroupRecipientDatabaseService->deleteMessageGroupRecipients($groupID);
    }

    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {
        $groupRecipients = $this->messageGroupRecipientDatabaseService->searchMessageGroupRecipientColumn($column, $value, $take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $groupRecipients['data'] = array_values(array_filter($groupRecipients['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message_group']['user_id']) && in_array($recipient['message_group']['user_id'], $usersIDs);
            }));
        }

        return $groupRecipients;
    }

    public function getMessageRecipients(string $messageID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageRecipients($messageID, $take);
    }

    public function getMessageGroupRecipients(string $messageGroupID, int $take = 10): array
    {
        return $this->messageGroupRecipientDatabaseService->getMessageGroupRecipients($messageGroupID, $take);
    }
}