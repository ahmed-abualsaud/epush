<?php

namespace Epush\Core\SenderConnection\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class GetSenderConnectionsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sender_id' => 'exists:senders,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSenderID(): string
    {
        return $this->data['sender_id']?? '';
    }
}