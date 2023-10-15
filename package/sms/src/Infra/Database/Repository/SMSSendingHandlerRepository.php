<?php

namespace Epush\SMS\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\SMS\Infra\Database\Model\SMSSendingHandler;
use Epush\SMS\Infra\Database\Repository\Contract\SMSSendingHandlerRepositoryContract;

class SMSSendingHandlerRepository implements SMSSendingHandlerRepositoryContract
{
    public function __construct(

        private SMSSendingHandler $smsSendingHandler
        
    ) {}

    public function paginate(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->smsSendingHandler->with(["smsTemplate"])->paginate($take)->toArray();

        });
    }

    public function get(string $smsSendingHandlerID): array
    {
        return DB::transaction(function () use ($smsSendingHandlerID) {

            $smsSendingHandler =  $this->smsSendingHandler->with(["smsTemplate"])->where('id', $smsSendingHandlerID)->first();
            return empty($smsSendingHandler) ? [] : $smsSendingHandler->toArray();

        });
    }
    
    public function create(array $smsSendingHandler): array
    {
        return DB::transaction(function () use ($smsSendingHandler) {

            return $this->smsSendingHandler->updateOrCreate([
                'handler_id' => $smsSendingHandler["handler_id"], 
            ], $smsSendingHandler)->toArray();

        });
    }

    public function update(string $smsSendingHandlerID, array $data): array
    {
        return DB::transaction(function () use ($smsSendingHandlerID, $data) {

            $smsSendingHandler = $this->smsSendingHandler->where('id', $smsSendingHandlerID)->firstOrFail();

            if (! empty($data)) {
                $smsSendingHandler->update($data);
            }

            return $smsSendingHandler->toArray();

        });
    }

    public function delete(string $smsSendingHandlerID): bool
    {
        return DB::transaction(function () use ($smsSendingHandlerID) {

            return $this->smsSendingHandler->where('id', $smsSendingHandlerID)->delete();

        }); 
    }

    public function getByHandlerID(string $handlerID): array
    {
        return DB::transaction(function () use ($handlerID) {

            $smsSendingHandler = $this->smsSendingHandler->where('handler_id', $handlerID)->first();
            return empty($smsSendingHandler) ? [] : $smsSendingHandler->toArray();

        });
    }

    public function getByHandlersID(array $handlersID, int $take): array
    {
        return DB::transaction(function () use ($handlersID, $take) {

            return $this->smsSendingHandler->with(["smsTemplate"])->whereIn('handler_id', $handlersID)->paginate($take)->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $smsSendingHandler = $this->smsSendingHandler->with(["smsTemplate"]);

            $smsSendingHandler = match ($column)
            {
                "template_name" =>
                $smsSendingHandler->whereHas('smsTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "subject", "template_subject" =>
                $smsSendingHandler->whereHas('smsTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(subject) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "template", "content", "template_content" =>
                $smsSendingHandler->whereHas('smsTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(template) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $smsSendingHandler->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $smsSendingHandler->paginate($take)->toArray();
        });
    }
}