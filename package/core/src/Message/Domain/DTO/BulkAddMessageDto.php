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
            'content' => 'array',
            'content.content' => 'string',
            'content.messages' => 'array',
            'content.messages.*.content' => 'string',
            'content.messages.*.title' => 'string',
            'content.messages.*.segments' => 'array',
            'content.messages.*.segments.*.number' => 'integer',
            'content.messages.*.segments.*.content' => 'string',
            'notes' => 'string',
            'scheduled_at' => 'string|nullable',
            'group_recipients' => 'array',
            'group_recipients.*.name' => 'string',
            'group_recipients.*.user_id' => 'exists:users,id',
            'group_recipients.*.recipients' => 'array',
            // 'group_recipients.*.recipients.*.number' => 'string',
            // 'group_recipients.*.recipients.*.attributes' => 'string|nullable',
            'segments' => 'array',
            'segments.*.number' => 'integer',
            'segments.*.content' => 'string',
            'send_type' => 'string',
            'draft' => 'boolean',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['draft']) && $this->data['draft'] = $this->data['draft'] == 'true';
        return $this->data;
    }

    public function getUserID(): string
    {
        return $this->data['user_id'];
    }

    public function getMessage(): array
    {
        ! empty($this->data['draft']) && $this->data['draft'] = $this->data['draft'] == 'true';
        ! empty($this->data['scheduled_at']) && $this->data['scheduled_at'] = toUTCDateTimeString($this->data['scheduled_at']);

        return subAssociativeArray([

            'user_id',
            'sender_id',
            'sender_ip',
            'order_id',
            'message_language_id',
            'content',
            'scheduled_at',
            'number_of_segments',
            'number_of_recipients',
            'send_type'

        ], $this->data);
    }

    public function getMessageGroupRecipients(): array
    {
        return $this->data['group_recipients'];
    }

    public function getSegments(): array
    {
        return $this->data['segments'] ?? [];
    }
}