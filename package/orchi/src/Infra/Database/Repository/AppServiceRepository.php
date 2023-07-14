<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\AppService;
use Epush\Orchi\Infra\Database\Repository\Contract\AppServiceRepositoryContract;

class AppServiceRepository implements AppServiceRepositoryContract {

    public function __construct(

        private AppService $appService

    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->appService->where('name', '<>', 'orchi')->get()->toArray();

        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            if (! empty($data)) {
                $this->appService->where('id', $id)->update($data);
            }

            return $this->appService->where('id', $id)->firstOrFail()->toArray();

        });
    }

    public function getLocalServices(): array
    {
        return DB::transaction(function () {

            return $this->appService->where('lookup_type', 'module')->get()->toArray();

        });
    }

    public function getRemoteServices(): array
    {
        return DB::transaction(function () {

            return $this->appService->where('lookup_type', '<>', 'module')->get()->toArray();

        });
    }
}