<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class OldApiSendBulkDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'username' => 'required|string|exists:users',
            'password' => 'required|string',
            'api_key' => 'required|string|exists:clients',
            'message' => 'required|string',
            'sender' => 'required|string|exists:senders,name',
            'mobiles' => 'required|array'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['scheduled_at']) && $this->data['scheduled_at'] = toUTCDateTimeString($this->data['scheduled_at']);

        return subAssociativeArray([

            'username',
            'password',
            'api_key',
            'message',
            'sender',
            'mobiles',
            'ip_address',
            'scheduled_at',
            'notes',
            'group_name'

        ], $this->data);
    }
}