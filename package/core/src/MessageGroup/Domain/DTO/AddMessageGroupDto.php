<?php

namespace Epush\Core\MessageGroup\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageGroupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:message_groups,name',
            'user_id' => 'required|exists:users,id',
            'number_of_recipients' => 'integer',
            'recipients' => 'array',
            'recipients.*.number'=> 'string',
            'recipients.*.attributes'=> 'json',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMessageGroup(): array
    {
        return subAssociativeArray([

            'name',
            'user_id',
            'saved',
            'number_of_recipients'

        ], $this->data);
    }

    public function getMessageGroupRecipients(): array
    {
        return $this->data['recipients'];
    }
}