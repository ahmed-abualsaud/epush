<?php

namespace Epush\Core\BusinessField\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\BusinessField\Infra\Database\Model\BusinessField;
use Epush\Core\BusinessField\Infra\Database\Repository\Contract\BusinessFieldRepositoryContract;

class BusinessFieldRepository implements BusinessFieldRepositoryContract
{
    public function __construct(

        private BusinessField $businessField,
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->businessField->all()->toArray();

        });
    }

    public function get(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->businessField->findOrFail($id)->toArray();
        });
    }

    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->businessField->create($client)->toArray();
        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $client = $this->businessField->findOrFail($id);

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        }); 
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            return $this->businessField->where('id', $id)->delete();

        }); 
    }
}