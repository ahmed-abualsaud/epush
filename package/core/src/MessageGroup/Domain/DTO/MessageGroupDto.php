<?php

namespace Epush\Core\MessageGroup\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class MessageGroupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_group_id' => 'exists:message_groups,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageGroupID(): string
    {
        return $this->data['message_group_id']?? '';
    }
}