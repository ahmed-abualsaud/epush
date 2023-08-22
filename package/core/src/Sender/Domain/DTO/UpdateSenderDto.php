<?php

namespace Epush\Core\Sender\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSenderDto implements DtoContract
{
    private static string $senderID;

    public function __construct(string $senderID, private array $data) 
    {
        self::$senderID = $senderID;
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'string|exists:clients,user_id',
            'name' => 'string',
            'approved' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['approved']) && $this->data['approved'] = $this->data['approved'] == 'true';
        return $this->data;
    }
}