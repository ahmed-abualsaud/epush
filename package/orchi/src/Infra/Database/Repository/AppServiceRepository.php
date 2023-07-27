<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\AppService;
use Epush\Orchi\Infra\Database\Repository\Contract\AppServiceRepositoryContract;

class AppServiceRepository implements AppServiceRepositoryContract 
{

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

            $appService = $this->appService->where('id', $id)->firstOrFail();

            if (! empty($data)) {
                $appService->update($data);

                // When disabling a service, disable all related contexts, handle_groups, and handlers
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $appService->contexts()->update(['enabled' => false]);
                    $appService->contexts->each(function ($context) {
                        $context->handleGroups()->update(['enabled' => false]);
                        $context->handleGroups->each(function ($handleGroup) {
                            $handleGroup->handlers()->update(['enabled' => false]);
                        });
                    });
                }
            }

            return $appService->toArray();

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