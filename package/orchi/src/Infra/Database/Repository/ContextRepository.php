<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\Context;
use Epush\Orchi\Infra\Database\Repository\Contract\ContextRepositoryContract;

class ContextRepository implements ContextRepositoryContract {

    public function __construct(

        private Context $context

    ) {}

    public function getAppServiceContexts(string $service_id): array
    {
        return DB::transaction(function () use ($service_id) {

            return $this->context->where('service_id', $service_id)->get()->toArray();

        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            if (! empty($data)) {
                $this->context->where('id', $id)->update($data);
            }

            return $this->context->where('id', $id)->firstOrFail()->toArray();

        });
    }
}