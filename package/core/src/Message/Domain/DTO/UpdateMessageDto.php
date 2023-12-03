<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageDto implements DtoContract
{
    private static string $messageID;

    public function __construct(string $messageID, private array $data) 
    {
        self::$messageID = $messageID;
    }

    public static function rules(): array
    {
        return [
            'sender_id' => 'exists:senders,id',
            'user_id' => 'exists:users,id',
            'order_id' => 'exists:orders,id',
            'message_language_id' => 'exists:message_languages,id',
            'content' => 'string',
            'notes' => 'string',
            'scheduled_at' => 'string|nullable',
            'group_recipients' => 'array',
            'group_recipients.*.name' => 'string',
            'group_recipients.*.user_id' => 'required|exists:users,id',
            'group_recipients.*.recipients' => 'array',
            'group_recipients.*.recipients.*.number' => 'string',
            'group_recipients.*.recipients.*.attributes' => 'string|nullable',
            'segments' => 'array',
            'segments.*.number' => 'integer',
            'segments.*.content' => 'string',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['scheduled_at']) && $this->data['scheduled_at'] = toUTCDateTimeString($this->data['scheduled_at']);

        return $this->data;
    }
}