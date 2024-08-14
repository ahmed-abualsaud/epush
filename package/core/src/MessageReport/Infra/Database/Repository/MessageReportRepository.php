<?php

namespace Epush\Core\MessageReport\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageReport\Infra\Database\Model\MessageReport;
use Epush\Core\MessageReport\Infra\Database\Repository\Contract\MessageReportRepositoryContract;

class MessageReportRepository implements MessageReportRepositoryContract
{
    public function __construct(

        private MessageReport $messageReport
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageReport->paginate($take)->toArray();

        });
    }

    public function get(string $messageID): array
    {
        return DB::transaction(function () use ($messageID) {

            $messageReport =  $this->messageReport->where('message_id', $messageID)->first();
            return empty($messageReport) ? [] : $messageReport->toArray();
        });
    }
    
    public function create(array $messageReport): array
    {
        return DB::transaction(function () use ($messageReport) {

            return $this->messageReport->create($messageReport)->toArray();
        });
    }

    public function delete(string $messageID): bool
    {
        return DB::transaction(function () use ($messageID) {

            return $this->messageReport->where('id', $messageID)->delete();

        }); 
    }

    public function update(string $messageID, array $data): array
    {
        return DB::transaction(function () use ($messageID, $data) {

            $messageReport = $this->messageReport->where('id', $messageID)->firstOrFail();

            if (! empty($data)) {
                $messageReport->update($data);
            }

            return $messageReport->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->messageReport
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}