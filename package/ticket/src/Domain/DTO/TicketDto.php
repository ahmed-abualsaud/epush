<?php

namespace Epush\Ticket\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class TicketDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'ticket_id' => 'exists:tickets,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getTicketID(): string
    {
        return $this->data['ticket_id']?? '';
    }
}