<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SendMessageDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'api_key' => 'required|string|exists:clients',
            'message' => 'required|string',
            'sender' => 'required|string|exists:senders,name',
            'numbers' => 'required|array',
            'language' => 'required|string|exists:message_languages,name',
            'scheduled_at' => 'string',
            'notes' => 'string',
            'group_name' => 'string|unique:message_groups,name',
            'send_type' => 'string'
        ];
    }

    public function toArray(): array
    {
        $this->data['language'] = ucfirst($this->data['language'] ?? null);
        ! empty($this->data['scheduled_at']) && $this->data['scheduled_at'] = toUTCDateTimeString($this->data['scheduled_at']);

        return subAssociativeArray([

            'api_key',
            'message',
            'sender',
            'numbers',
            'language',
            'ip_address',
            'scheduled_at',
            'notes',
            'group_name',
            'send_type'

        ], $this->data);
    }
}