<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class BulkAddMessageDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sender_id' => 'required|exists:senders,id',
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'message_language_id' => 'required|exists:message_languages,id',
            'content' => 'required|array',
            'notes' => 'string',
            'scheduled_at' => 'integer',
            'recipients' => 'array|required',
            'segments' => 'array|required'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessage(): array
    {
        return subAssociativeArray([

            'sender_id',
            'order_id',
            'message_language_id',
            'content',
            'scheduled_at',
            'number_of_segments',
            'number_of_recipients'

        ], $this->data);
    }

    public function getUserID(): string
    {
        return $this->data['user_id'];
    }

    public function getRecipients(): array
    {
        return $this->data['recipients'];
    }

    public function getSegments(): array
    {
        return $this->data['segments'];
    }
}