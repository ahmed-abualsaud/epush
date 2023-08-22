<?php

namespace Epush\Core\Operator\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Operator\Infra\Database\Model\Operator;
use Epush\Core\Operator\Infra\Database\Repository\Contract\OperatorRepositoryContract;

class OperatorRepository implements OperatorRepositoryContract
{
    public function __construct(

        private Operator $operator
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->operator->paginate($take)->toArray();

        });
    }

    public function get(string $operatorID): array
    {
        return DB::transaction(function () use ($operatorID) {

            $operator =  $this->operator->where('id', $operatorID)->first();
            return empty($operator) ? [] : $operator->toArray();
        });
    }
    
    public function create(array $operator): array
    {
        return DB::transaction(function () use ($operator) {

            return $this->operator->create($operator)->toArray();
        });
    }

    public function delete(string $operatorID): bool
    {
        return DB::transaction(function () use ($operatorID) {

            return $this->operator->where('id', $operatorID)->delete();

        }); 
    }

    public function update(string $operatorID, array $data): array
    {
        return DB::transaction(function () use ($operatorID, $data) {

            $operator = $this->operator->where('id', $operatorID)->firstOrFail();

            if (! empty($data)) {
                $operator->update($data);
            }

            return $operator->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->operator
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}