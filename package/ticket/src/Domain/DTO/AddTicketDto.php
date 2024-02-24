<?php

namespace Epush\Ticket\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddTicketDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'company_name' => 'required|string|exists:clients,company_name',
            'sender_name' => 'required|string|exists:senders,name',
            'content' => 'required|string',
            'subject' => 'required|string',
            'status' => 'string|in:Initiated,Processing,Completed,Closed',
            'notes' => 'string|nullable'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}