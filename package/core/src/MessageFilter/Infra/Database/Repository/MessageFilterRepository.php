<?php

namespace Epush\Core\MessageFilter\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageFilter\Infra\Database\Model\MessageFilter;
use Epush\Core\MessageFilter\Infra\Database\Repository\Contract\MessageFilterRepositoryContract;

class MessageFilterRepository implements MessageFilterRepositoryContract
{
    public function __construct(

        private MessageFilter $messageFilter
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageFilter->paginate($take)->toArray();

        });
    }

    public function get(string $messageFilterID): array
    {
        return DB::transaction(function () use ($messageFilterID) {

            $messageFilter =  $this->messageFilter->where('id', $messageFilterID)->first();
            return empty($messageFilter) ? [] : $messageFilter->toArray();
        });
    }
    
    public function create(array $messageFilter): array
    {
        return DB::transaction(function () use ($messageFilter) {

            return $this->messageFilter->create($messageFilter)->toArray();
        });
    }

    public function delete(string $messageFilterID): bool
    {
        return DB::transaction(function () use ($messageFilterID) {

            return $this->messageFilter->where('id', $messageFilterID)->delete();

        }); 
    }

    public function update(string $messageFilterID, array $data): array
    {
        return DB::transaction(function () use ($messageFilterID, $data) {

            $messageFilter = $this->messageFilter->where('id', $messageFilterID)->firstOrFail();

            if (! empty($data)) {
                $messageFilter->update($data);
            }

            return $messageFilter->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->messageFilter
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}