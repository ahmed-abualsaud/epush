<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\Handler;
use Epush\Orchi\Infra\Database\Repository\Contract\HandlerRepositoryContract;

class HandlerRepository implements HandlerRepositoryContract 
{

    public function __construct(

        private Handler $handler

    ) {}

    public function paginate(int $take = 10): array
    {
        return DB::transaction(function () use ($take) {

            return $this->handler->paginate($take)->toArray();

        });
    }

    public function getHandler(string $handlerID): array
    {
        return DB::transaction(function () use ($handlerID) {

            $handler = $this->handler->where('id', $handlerID)->first();
            return empty($handler) ? [] : $handler->toArray();

        });
    }

    public function getHandleGroupHandlers(string $handle_group_id): array
    {
        return DB::transaction(function () use ($handle_group_id) {

            return $this->handler->where('handle_group_id', $handle_group_id)->get()->toArray();

        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $handler = $this->handler->where('id', $id)->firstOrFail();

            if (! empty($data)) {
                $handler->update($data);

                // When disabling a handler, check if the rest of the handlers are all disabled, and if they are all disabled, disable the handle_group that owns them
                if (array_key_exists('enabled', $data) && ! $data['enabled']) {
                    $handleGroup = $handler->handleGroup;
                    if (! $handleGroup->handlers()->where('enabled', true)->exists()) {
                        $handleGroup->update(['enabled' => false]);
                        $context = $handleGroup->context;
                        if (! $context->handleGroups()->where('enabled', true)->exists()) {
                            $context->update(['enabled' => false]);
                            $service = $context->service;
                            if (! $service->contexts()->where('enabled', true)->exists()) {
                                $service->update(['enabled' => false]);
                            }
                        }
                    }
                }
                // When enabling a handler, check if the handle_group that owns it is disabled or not and if it isdisabled, enable it
                if (array_key_exists('enabled', $data) && $data['enabled']) {
                    $handleGroup = $handler->handleGroup;
                    if (! $handleGroup->enabled) {
                        $handleGroup->update(['enabled' => true]);
                    }
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

            return $handler->toArray();

        });
    }

    public function getHandlers(array $ids): array
    {
        return DB::transaction(function () use ($ids) {

            if (empty($ids)) { return []; }

            return $this->handler->select('contexts.name as context_name', 'contexts.online as context_online',
                    'contexts.enabled as context_enabled', 'handle_groups.name as handle_group_name',
                    'handle_groups.enabled as handle_group_enabled', 'handlers.name as handler_name',
                    'handlers.enabled as handler_enabled', 'handlers.endpoint as handler_endpoint',
                    'handlers.description as handler_description', 'handlers.id as handler_id')
                ->join('handle_groups', 'handle_groups.id', '=', 'handlers.handle_group_id')
                ->join('contexts', 'contexts.id', '=', 'handle_groups.context_id')
                ->whereIn('handlers.id', $ids)
                ->get()->toArray();

        });
    }

    public function getHandlerByEndpoint(string $endpoint): array
    {
        return DB::transaction(function () use ($endpoint) {

            $data = explode('|', $endpoint);
            $method = $data[0];
            $path = $data[1];
            $endpointParts = explode('/', $path);
            $endpointPartsLength = count($endpointParts);

            $endpoints = $this->handler->where('endpoint', 'like', $method.'|%')->get()->toArray();

            foreach($endpoints as $e) {
                $urlParts = explode('/', explode('|', $e['endpoint'])[1]);
                $urlPartsLength = count($urlParts);
                if ($urlPartsLength !== $endpointPartsLength) { continue; }
                $match = true;

                for($i = 0; $i < $urlPartsLength; $i++) {
                    if($urlParts[$i] != $endpointParts[$i] && !preg_match('/^{.*}$/', $urlParts[$i])) {
                        $match = false;
                        break;
                    }
                }
            
                if($match) {
                    return $e;
                }
            }
            
            return [];
        });
    }

    public function getAllHandlersResponseAttributes(): array
    {
        return DB::transaction(function () {

            return $this->handler->select("endpoint", "response_attributes")->get()->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->handler
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();

        });
    }
}