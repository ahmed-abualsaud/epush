<?php

namespace Epush\Core\MessageRecipient\App\Service;


use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageRecipientService implements MessageRecipientServiceContract
{
    public function __construct(

        private InterprocessCommunicationEngineContract $communicationEngine,

        private MessageRecipientDatabaseServiceContract $messageRecipientDatabaseService

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $messageRecipients = $this->messageRecipientDatabaseService->paginateMessageRecipients($take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $messageRecipients['data'] = array_values(array_filter($messageRecipients['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message_group_recipient']['message_group']['user_id']) && in_array($recipient['message_group_recipient']['message_group']['user_id'], $usersIDs);
            }));
        }

        return $messageRecipients;
    }

    public function add(string $messageID, array $messageGroupRecipientIDs, $status = 'Initialized'): array
    {
        return $this->messageRecipientDatabaseService->addMessageRecipients($messageID, $messageGroupRecipientIDs, $status);
    }

    public function update(string $messageID, array $data): array
    {
        return $this->messageRecipientDatabaseService->updateMessageRecipients($messageID, $data);
    }

    public function delete(string $messageID): bool
    {
        return $this->messageRecipientDatabaseService->deleteMessageRecipients($messageID);
    }

    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {
        $messageRecipients = $this->messageRecipientDatabaseService->searchMessageRecipientColumn($column, $value, $take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $messageRecipients['data'] = array_values(array_filter($messageRecipients['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message_group_recipient']['message_group']['user_id']) && in_array($recipient['message_group_recipient']['message_group']['user_id'], $usersIDs);
            }));
        }

        return $messageRecipients;
    }
}