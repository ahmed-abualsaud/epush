<?php

namespace Epush\Core\MessageReport\App\Service;


use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Core\MessageReport\App\Contract\MessageReportDatabaseServiceContract;

class MessageReportService implements MessageReportServiceContract
{
    public function __construct(

        private MessageReportDatabaseServiceContract $messageReportDatabaseService

    ) {}


    public function list(int $take): array
    {
        return $this->messageReportDatabaseService->paginateMessageReports($take);
    }

    public function get(string $messageID): array
    {
        return $this->messageReportDatabaseService->getMessageReport($messageID);
    }

    public function add(array $messageReport): array
    {
        return $this->messageReportDatabaseService->addMessageReport($messageReport);
    }

    public function update(string $messageID, array $messageReport): array
    {
        return $this->messageReportDatabaseService->updateMessageReport($messageID, $messageReport);
    }

    public function delete(string $messageID): bool
    {
        return $this->messageReportDatabaseService->deleteMessageReport($messageID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageReportDatabaseService->searchMessageReportColumn($column, $value, $take);
    }

    public function getMessageClientReports(string $userID): array
    {
        return $this->messageReportDatabaseService->getMessageClientReports($userID);
    }
}