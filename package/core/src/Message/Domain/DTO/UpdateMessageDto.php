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
            'sender_id' => 'required|exists:senders,id',
            'order_id' => 'required|exists:orders,id',
            'message_language_id' => 'required|exists:message_languages,id',
            'content' => 'required|string',
            'notes' => 'string',
            'scheduled_at' => 'integer',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}