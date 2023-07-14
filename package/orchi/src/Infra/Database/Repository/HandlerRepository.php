<?php

namespace Epush\Orchi\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Orchi\Infra\Database\Model\Handler;
use Epush\Orchi\Infra\Database\Repository\Contract\HandlerRepositoryContract;

class HandlerRepository implements HandlerRepositoryContract {

    public function __construct(

        private Handler $handler

    ) {}

    public function getHandleGroupHandlers(string $handle_group_id): array
    {
        return DB::transaction(function () use ($handle_group_id) {

            return $this->handler->where('handle_group_id', $handle_group_id)->get()->toArray();

        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            if (! empty($data)) {
                $this->handler->where('id', $id)->update($data);
            }

            return $this->handler->where('id', $id)->firstOrFail()->toArray();

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
                    'handlers.id as handler_id')
                ->join('handle_groups', 'handle_groups.id', '=', 'handlers.handle_group_id')
                ->join('contexts', 'contexts.id', '=', 'handle_groups.context_id')
                ->whereIn('handlers.id', $ids)
                ->get()->toArray();

        });
    }
}