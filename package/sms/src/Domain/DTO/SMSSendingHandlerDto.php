<?php

namespace Epush\SMS\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SMSSendingHandlerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sms_sending_handler_id' => 'exists:sms_sending_handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSMSSendingHandlerID(): string
    {
        return $this->data['sms_sending_handler_id']?? '';
    }
}