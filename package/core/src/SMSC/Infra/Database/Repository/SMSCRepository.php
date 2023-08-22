<?php

namespace Epush\Core\SMSC\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\SMSC\Infra\Database\Model\SMSC;
use Epush\Core\SMSC\Infra\Database\Repository\Contract\SMSCRepositoryContract;

class SMSCRepository implements SMSCRepositoryContract
{
    public function __construct(

        private SMSC $smsc
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->smsc->paginate($take)->toArray();

        });
    }

    public function get(string $smscID): array
    {
        return DB::transaction(function () use ($smscID) {

            $smsc =  $this->smsc->where('id', $smscID)->first();
            return empty($smsc) ? [] : $smsc->toArray();
        });
    }
    
    public function create(array $smsc): array
    {
        return DB::transaction(function () use ($smsc) {

            return $this->smsc->create($smsc)->toArray();
        });
    }

    public function delete(string $smscID): bool
    {
        return DB::transaction(function () use ($smscID) {

            return $this->smsc->where('id', $smscID)->delete();

        }); 
    }

    public function update(string $smscID, array $data): array
    {
        return DB::transaction(function () use ($smscID, $data) {

            $smsc = $this->smsc->where('id', $smscID)->firstOrFail();

            if (! empty($data)) {
                $smsc->update($data);
            }

            return $smsc->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->smsc
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}