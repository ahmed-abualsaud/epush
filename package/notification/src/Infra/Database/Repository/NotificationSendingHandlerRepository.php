<?php

namespace Epush\Notification\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Notification\Infra\Database\Model\NotificationSendingHandler;
use Epush\Notification\Infra\Database\Repository\Contract\NotificationSendingHandlerRepositoryContract;

class NotificationSendingHandlerRepository implements NotificationSendingHandlerRepositoryContract
{
    public function __construct(

        private NotificationSendingHandler $notificationSendingHandler
        
    ) {}

    public function paginate(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->notificationSendingHandler->with(["notificationTemplate"])->paginate($take)->toArray();

        });
    }

    public function get(string $notificationSendingHandlerID): array
    {
        return DB::transaction(function () use ($notificationSendingHandlerID) {

            $notificationSendingHandler =  $this->notificationSendingHandler->with(["notificationTemplate"])->where('id', $notificationSendingHandlerID)->first();
            return empty($notificationSendingHandler) ? [] : $notificationSendingHandler->toArray();

        });
    }
    
    public function create(array $notificationSendingHandler): array
    {
        return DB::transaction(function () use ($notificationSendingHandler) {

            return $this->notificationSendingHandler->updateOrCreate([
                'handler_id' => $notificationSendingHandler["handler_id"], 
            ], $notificationSendingHandler)->toArray();

        });
    }

    public function update(string $notificationSendingHandlerID, array $data): array
    {
        return DB::transaction(function () use ($notificationSendingHandlerID, $data) {

            $notificationSendingHandler = $this->notificationSendingHandler->where('id', $notificationSendingHandlerID)->firstOrFail();

            if (! empty($data)) {
                $notificationSendingHandler->update($data);
            }

            return $notificationSendingHandler->toArray();

        });
    }

    public function delete(string $notificationSendingHandlerID): bool
    {
        return DB::transaction(function () use ($notificationSendingHandlerID) {

            return $this->notificationSendingHandler->where('id', $notificationSendingHandlerID)->delete();

        }); 
    }

    public function getByHandlerID(string $handlerID): array
    {
        return DB::transaction(function () use ($handlerID) {

            $notificationSendingHandler = $this->notificationSendingHandler->where('handler_id', $handlerID)->first();
            return empty($notificationSendingHandler) ? [] : $notificationSendingHandler->toArray();

        });
    }

    public function getByHandlersID(array $handlersID, int $take): array
    {
        return DB::transaction(function () use ($handlersID, $take) {

            return $this->notificationSendingHandler->with(["notificationTemplate"])->whereIn('handler_id', $handlersID)->paginate($take)->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $notificationSendingHandler = $this->notificationSendingHandler->with(["notificationTemplate"]);

            $notificationSendingHandler = match ($column)
            {
                "template_name" =>
                $notificationSendingHandler->whereHas('NotificationTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "subject", "template_subject" =>
                $notificationSendingHandler->whereHas('NotificationTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(subject) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "template", "content", "template_content" =>
                $notificationSendingHandler->whereHas('NotificationTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(template) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $notificationSendingHandler->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $notificationSendingHandler->paginate($take)->toArray();
        });
    }
}