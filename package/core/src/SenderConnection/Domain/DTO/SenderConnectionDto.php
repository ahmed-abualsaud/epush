<?php

namespace Epush\Core\SenderConnection\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SenderConnectionDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sender_connection_id' => 'exists:senders_connections,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSenderConnectionID(): string
    {
        return $this->data['sender_connection_id']?? '';
    }
}