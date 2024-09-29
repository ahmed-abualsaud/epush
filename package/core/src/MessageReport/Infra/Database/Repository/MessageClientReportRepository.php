<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageReport\Infra\Database\Model\MessageClientReport;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageClientReportRepositoryContract;

class MessageClientReportRepository implements MessageClientReportRepositoryContract
{
    public function __construct(

        private MessageClientReport $messageClientReport
        
    ) {}

    public function getMessageClientReports(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            $messageReport = $this->messageClientReport->where('user_id', $userID)->first();
            return empty($messageReport) ? [] : $messageReport->toArray();
        });
    }
}