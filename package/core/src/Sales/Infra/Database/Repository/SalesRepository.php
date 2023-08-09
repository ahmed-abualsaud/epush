<?php

namespace Epush\Core\Sales\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Sales\Infra\Database\Model\Sales;
use Epush\Core\Sales\Infra\Database\Repository\Contract\SalesRepositoryContract;

class SalesRepository implements SalesRepositoryContract
{
    public function __construct(

        private Sales $sales,
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->sales->all()->toArray();

        });
    }

    public function get(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->sales->findOrFail($id)->toArray();
        });
    }

    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->sales->create($client)->toArray();
        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $client = $this->sales->findOrFail($id);

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        }); 
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            return $this->sales->where('id', $id)->delete();

        }); 
    }
}