<?php

namespace Epush\Core\SMSC\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SMSCDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'smsc_id' => 'exists:smscs,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSMSCID(): string
    {
        return $this->data['smsc_id']?? '';
    }
}