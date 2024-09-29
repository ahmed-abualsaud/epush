<?php

namespace Epush\Core\MessageReport\App\Service;

use Epush\Core\MessageReport\App\Contract\MessageReportDatabaseServiceContract;
use Epush\Core\MessageReport\Infra\Database\Driver\MessageReportDatabaseDriverContract;

class MessageReportDatabaseService implements MessageReportDatabaseServiceContract
{
    public function __construct(

        private MessageReportDatabaseDriverContract $messageReportDatabaseDriver

    ) {}

    public function getMessageReport(string $messageID): array
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->get($messageID);
    }

    public function paginateMessageReports(int $take): array
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->all($take);
    }

    public function addMessageReport(array $messageReport): array
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->create($messageReport);
    }

    public function updateMessageReport(string $messageID, array $messageReport): array
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->update($messageID, $messageReport);
    }

    public function deleteMessageReport(string $messageID): bool
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->delete($messageID);
    }

    public function searchMessageReportColumn(string $column, string $value, int $take = 10): array
    {
        return $this->messageReportDatabaseDriver->messageReportRepository()->searchColumn($column, $value, $take);
    }

    public function getMessageClientReports(string $userID): array
    {
        return $this->messageReportDatabaseDriver->messageClientReportRepository()->getMessageClientReports($userID);
    }

    public function initMessageClientReports(string $userID): array
    {
        return $this->messageReportDatabaseDriver->messageClientReportRepository()->initMessageClientReports($userID);
    }

    public function updateMessageClientReports(string $userID, int $count = 0): int
    {
        return $this->messageReportDatabaseDriver->messageClientReportRepository()->updateMessageClientReports($userID, $count);
    }
}