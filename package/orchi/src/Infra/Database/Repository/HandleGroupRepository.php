<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\HandleGroup;
use Epush\Orchi\Infra\Database\Repository\Contract\HandleGroupRepositoryContract;

class HandleGroupRepository implements HandleGroupRepositoryContract 
{

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

            $handleGroup = $this->handleGroup->where('id', $id)->firstOrFail();

            if (! empty($data)) {
                $handleGroup->update($data);

                // When disabling a handle_group, disable all related handlers
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $handleGroup->handlers()->update(['enabled' => false]);
                }
                // When disabling a handle_group, check if the rest of the handle_groups are all disabled, and if they are all disabled, disable the context that owns them
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $context = $handleGroup->context;
                    if (! $context->handleGroups()->where('enabled', true)->exists()) {
                        $context->update(['enabled' => false]);
                        $service = $context->service;
                        if (! $service->contexts()->where('enabled', true)->exists()) {
                            $service->update(['enabled' => false]);
                        }
                    }
                }
                // When enabling a handle_group, check if the context that owns it is disabled or not and if it is disabled, enable it
                if (array_key_exists('enabled', $data) && $data['enabled']) {
                    $context = $handleGroup->context;
                    if (! $context->enabled) {
                        $context->update(['enabled' => true]);
                    }
                    $service = $context->service;
                    if (! $service->enabled) {
                        $service->update(['enabled' => true]);
                    }
                }
            }

            return $handleGroup->toArray();

        });
    }
}