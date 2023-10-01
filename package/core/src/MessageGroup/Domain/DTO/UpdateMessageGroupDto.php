<?php

namespace Epush\Core\MessageGroup\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageGroupDto implements DtoContract
{
    private static string $messageGroupID;

    public function __construct(string $messageGroupID, private array $data) 
    {
        self::$messageGroupID = $messageGroupID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:message_groups,name,'.self::$messageGroupID.'|string',
            'recipients' => 'array',
            'recipients.*.number'=> 'string',
            'recipients.*.attributes'=> 'json',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}