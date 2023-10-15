<?php

namespace Epush\Mail\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Mail\Infra\Database\Model\MailSendingHandler;
use Epush\Mail\Infra\Database\Repository\Contract\MailSendingHandlerRepositoryContract;

class MailSendingHandlerRepository implements MailSendingHandlerRepositoryContract
{
    public function __construct(

        private MailSendingHandler $mailSendingHandler
        
    ) {}

    public function paginate(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->mailSendingHandler->with(["mailTemplate"])->paginate($take)->toArray();

        });
    }

    public function get(string $mailSendingHandlerID): array
    {
        return DB::transaction(function () use ($mailSendingHandlerID) {

            $mailSendingHandler =  $this->mailSendingHandler->with(["mailTemplate"])->where('id', $mailSendingHandlerID)->first();
            return empty($mailSendingHandler) ? [] : $mailSendingHandler->toArray();

        });
    }
    
    public function create(array $mailSendingHandler): array
    {
        return DB::transaction(function () use ($mailSendingHandler) {

            return $this->mailSendingHandler->updateOrCreate([
                'handler_id' => $mailSendingHandler["handler_id"], 
            ], $mailSendingHandler)->toArray();

        });
    }

    public function update(string $mailSendingHandlerID, array $data): array
    {
        return DB::transaction(function () use ($mailSendingHandlerID, $data) {

            $mailSendingHandler = $this->mailSendingHandler->where('id', $mailSendingHandlerID)->firstOrFail();

            if (! empty($data)) {
                $mailSendingHandler->update($data);
            }

            return $mailSendingHandler->toArray();

        });
    }

    public function delete(string $mailSendingHandlerID): bool
    {
        return DB::transaction(function () use ($mailSendingHandlerID) {

            return $this->mailSendingHandler->where('id', $mailSendingHandlerID)->delete();

        }); 
    }

    public function getByHandlerID(string $handlerID): array
    {
        return DB::transaction(function () use ($handlerID) {

            $mailSendingHandler = $this->mailSendingHandler->where('handler_id', $handlerID)->first();
            return empty($mailSendingHandler) ? [] : $mailSendingHandler->toArray();

        });
    }

    public function getByHandlersID(array $handlersID, int $take): array
    {
        return DB::transaction(function () use ($handlersID, $take) {

            return $this->mailSendingHandler->with(["mailTemplate"])->whereIn('handler_id', $handlersID)->paginate($take)->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $mailSendingHandler = $this->mailSendingHandler->with(["mailTemplate"]);

            $mailSendingHandler = match ($column)
            {
                "template_name" =>
                $mailSendingHandler->whereHas('mailTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "subject", "template_subject" =>
                $mailSendingHandler->whereHas('mailTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(subject) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "template", "content", "template_content" =>
                $mailSendingHandler->whereHas('mailTemplate', function ($query) use ($value) {
                    $query->whereRaw("LOWER(template) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $mailSendingHandler->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $mailSendingHandler->paginate($take)->toArray();
        });
    }
}