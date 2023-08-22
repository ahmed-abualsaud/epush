<?php

namespace Epush\Core\SMSCBinding\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\SMSCBinding\Infra\Database\Model\SMSCBinding;
use Epush\Core\SMSCBinding\Infra\Database\Repository\Contract\SMSCBindingRepositoryContract;

class SMSCBindingRepository implements SMSCBindingRepositoryContract
{
    public function __construct(

        private SMSCBinding $smscBinding
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->smscBinding->with(['country', 'operator', 'smsc'])->paginate($take)->toArray();

        });
    }

    public function get(string $smscBindingID): array
    {
        return DB::transaction(function () use ($smscBindingID) {

            $smscBinding =  $this->smscBinding->with(['country', 'operator', 'smsc'])->where('id', $smscBindingID)->first();
            return empty($smscBinding) ? [] : $smscBinding->toArray();
        });
    }
    
    public function create(array $smscBinding): array
    {
        return DB::transaction(function () use ($smscBinding) {

            if ($smscBinding["default"]) {
                $this->smscBinding->where('country_id', $smscBinding['country_id'])
                    ->where('operator_id', $smscBinding['operator_id'])
                    ->update(['default' => false]);
            }

            $input = [
                'country_id' => $smscBinding["country_id"], 
                'operator_id' => $smscBinding["operator_id"],
                'smsc_id' => $smscBinding["smsc_id"],
                'default' => $smscBinding["default"],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            return $this->smscBinding->updateOrCreate([
                'country_id' => $smscBinding["country_id"], 
                'operator_id' => $smscBinding["operator_id"],
                'smsc_id' => $smscBinding["smsc_id"],
            ], $input)->toArray();
        });
    }

    public function delete(string $smscBindingID): bool
    {
        return DB::transaction(function () use ($smscBindingID) {

            return $this->smscBinding->where('id', $smscBindingID)->delete();

        }); 
    }

    public function update(string $smscBindingID, array $data): array
    {
        return DB::transaction(function () use ($smscBindingID, $data) {

            $smscBinding = $this->smscBinding->where('id', $smscBindingID)->firstOrFail();

            if (! empty($data)) {
                $smscBinding->update($data);
            }

            return $smscBinding->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $smscBinding = $this->smscBinding->with(['country', 'operator', 'smsc']);

            $smscBinding = match ($column) 
            {
                "country_name", "country_code" => $smscBinding->whereHas('country', function ($query) use ($column, $value) {
                    $query->whereRaw("LOWER(".explode('_', $column)[1].") LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "operator_name", "operator_code" => $smscBinding->whereHas('operator', function ($query) use ($column, $value) {
                    $query->whereRaw("LOWER(".explode('_', $column)[1].") LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "smsc_name", "smsc_value" => $smscBinding->whereHas('smsc', function ($query) use ($column, $value) {
                    $query->whereRaw("LOWER(".explode('_', $column)[1].") LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $smscBinding->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            $smscBinding = $take >= 1000000000000 ? $smscBinding->paginate($take, ['*'], 'page', 1) : $smscBinding->paginate($take);
            return $smscBinding->toArray();
        });
    }
}