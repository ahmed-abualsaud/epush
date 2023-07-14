<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\HandleGroup;
use Epush\Orchi\Infra\Database\Repository\Contract\HandleGroupRepositoryContract;

class HandleGroupRepository implements HandleGroupRepositoryContract {

    public function __construct(

        private HandleGroup $handleGroup

    ) {}

    public function getContextHandleGroups(string $context_id): array
    {
        return DB::transaction(function () use ($context_id) {

            return $this->handleGroup->where('context_id', $context_id)->get()->toArray();

        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            if (! empty($data)) {
                $this->handleGroup->where('id', $id)->update($data);
            }

            return $this->handleGroup->where('id', $id)->firstOrFail()->toArray();

        });
    }
}