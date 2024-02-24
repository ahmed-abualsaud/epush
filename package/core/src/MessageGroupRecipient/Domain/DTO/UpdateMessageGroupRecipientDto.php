<?php

namespace Epush\Core\MessageGroupRecipient\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageGroupRecipientDto implements DtoContract
{
    private static string $messageGroupRecipientID;

    public function __construct(string $messageGroupRecipientID, private array $data) 
    {
        self::$messageGroupRecipientID = $messageGroupRecipientID;
    }

    public static function rules(): array
    {
        return [
            'message_group_id' =>'required|exists:message_groups,id',
            'number'=> 'string',
            'attributes'=> 'json|nullable',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}