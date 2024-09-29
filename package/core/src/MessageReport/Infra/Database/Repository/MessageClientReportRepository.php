<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageReport\Infra\Database\Model\MessageReport;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageClientReportRepositoryContract;

class MessageClientReportRepository implements MessageClientReportRepositoryContract
{
    public function __construct(

        private MessageReport $messageReport
        
    ) {}

    public function getMessageClientReports(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->messageReport->where('user_id', $userID)->get()->toArray();

        });
    }
}