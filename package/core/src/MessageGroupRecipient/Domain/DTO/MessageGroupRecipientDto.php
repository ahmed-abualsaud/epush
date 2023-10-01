<?php

namespace Epush\Core\MessageGroupRecipient\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MessageGroupRecipientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_group_recipient_id' => 'exists:message_group_recipients,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageGroupRecipientID(): string
    {
        return $this->data['message_group_recipient_id']?? '';
    }
}