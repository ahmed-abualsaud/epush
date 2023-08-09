<?php

namespace Epush\Core\Pricelist\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Pricelist\Infra\Database\Model\Pricelist;
use Epush\Core\Pricelist\Infra\Database\Repository\Contract\PricelistRepositoryContract;

class PricelistRepository implements PricelistRepositoryContract
{
    public function __construct(

        private Pricelist $pricelist,
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->pricelist->all()->toArray();

        });
    }

    public function get(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->pricelist->findOrFail($id)->toArray();
        });
    }

    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->pricelist->create($client)->toArray();
        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $client = $this->pricelist->findOrFail($id);

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        }); 
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            return $this->pricelist->where('id', $id)->delete();

        }); 
    }
}