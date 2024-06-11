<?php

namespace Epush\Core\MessageSegment\App\Service;


use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MessageSegmentService implements MessageSegmentServiceContract
{
    public function __construct(

        private InterprocessCommunicationEngineContract $communicationEngine,

        private MessageSegmentDatabaseServiceContract $messageSegmentDatabaseService

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $messageSegments = $this->messageSegmentDatabaseService->paginateMessageSegments($take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $messageSegments['data'] = array_values(array_filter($messageSegments['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message']['user_id']) && in_array($recipient['message']['user_id'], $usersIDs);
            }));
        }

        return $messageSegments;
    }

    public function add(string $messageID, array $messageSegments): array
    {
        return $this->messageSegmentDatabaseService->addMessageSegments($messageID, $messageSegments);
    }

    public function delete(string $messageID): bool
    {
        return $this->messageSegmentDatabaseService->deleteMessageSegments($messageID);
    }


    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {
        $messageSegments = $this->messageSegmentDatabaseService->searchMessageSegmentColumn($column, $value, $take);

        if (! empty($partnerID)) {
            $clients = $this->communicationEngine->broadcast("core:client:list-clients", 1000000000000000, $partnerID)[0];

            $usersIDs = array_map(function ($client) {
                return $client['user_id'];
            }, $clients['data']);

            $messageSegments['data'] = array_values(array_filter($messageSegments['data'], function ($recipient) use ($usersIDs) {
                return ! empty($recipient['message']['user_id']) && in_array($recipient['message']['user_id'], $usersIDs);
            }));
        }

        return $messageSegments;
    }
}