<?php

namespace Epush\Core\SenderConnection\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSenderConnectionDto implements DtoContract
{
    private static string $senderConnectionID;

    public function __construct(string $senderConnectionID, private array $data) 
    {
        self::$senderConnectionID = $senderConnectionID;
    }

    public static function rules(): array
    {
        return [
            'sender_id' => 'string|exists:senders,id',
            'smsc_id' => 'string|exists:smscs,id',
            'approved' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['approved']) && $this->data['approved'] = $this->data['approved'] == 'true';
        return $this->data;
    }
}