<?php

namespace Epush\Core\MessageGroup\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class GetMessageGroupRecipientsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'message_group_id' => 'exists:message_groups,id',
            'take' => 'integer',
            'page' => 'integer'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageGroupID(): string
    {
        return $this->data['message_group_id'];
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }
}