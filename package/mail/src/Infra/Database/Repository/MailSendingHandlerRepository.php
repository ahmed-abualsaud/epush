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

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->mailSendingHandler->all()->toArray();

        });
    }

    public function get(string $mailSendingHandlerID): array
    {
        return DB::transaction(function () use ($mailSendingHandlerID) {

            $mailSendingHandler =  $this->mailSendingHandler->where('id', $mailSendingHandlerID)->first();
            return empty($mailSendingHandler) ? [] : $mailSendingHandler->toArray();

        });
    }
    
    public function create(array $mailSendingHandler): array
    {
        return DB::transaction(function () use ($mailSendingHandler) {

            return $this->mailSendingHandler->create($mailSendingHandler)->toArray();

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

            $mailSendingHandler =  $this->mailSendingHandler->where('handler_id', $handlerID)->first();
            return empty($mailSendingHandler) ? [] : $mailSendingHandler->toArray();

        });
    }
}