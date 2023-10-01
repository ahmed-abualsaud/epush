<?php

namespace Epush\Core\MessageGroupRecipient\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageGroupRecipientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_group_id' =>'required|exists:message_groups,id',
            'recipients' => 'required|array',
            'recipients.*.number'=> 'required|string',
            'recipients.*.attributes'=> 'json',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getGroupID(): string
    {
        return $this->data['message_group_id'];
    }

    public function getGroupRecipients(): array
    {
        return $this->data['recipients'];
    }
}