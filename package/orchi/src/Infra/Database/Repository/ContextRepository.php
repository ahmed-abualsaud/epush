<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\Context;
use Epush\Orchi\Infra\Database\Repository\Contract\ContextRepositoryContract;

class ContextRepository implements ContextRepositoryContract 
{

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

            $context = $this->context->where('id', $id)->firstOrFail();

            if (! empty($data)) {
                $context->update($data);

                // When disabling a context, disable all related handle_groups and handlers
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $context->handleGroups()->update(['enabled' => false]);
                    $context->handleGroups->each(function ($handleGroup) {
                        $handleGroup->handlers()->update(['enabled' => false]);
                    });
                }
                // When disabling a context, check if the rest of the contexts are all disabled, and if they are all disabled, disable the service that owns them
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $service = $context->service;
                    if (! $service->contexts()->where('enabled', true)->exists()) {
                        $service->update(['enabled' => false]);
                    }
                }
                // When enabling a context, check if the service that owns it is disabled or not and if it is disabled, enable it
                if (array_key_exists('enabled', $data) && $data['enabled']) {
                    $service = $context->service;
                    if (! $service->enabled) {
                        $service->update(['enabled' => true]);
                    }
                }
            }

            return $context->toArray();

        });
    }
}