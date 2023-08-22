<?php

namespace Epush\Core\SMSCBinding\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SMSCBindingDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'smsc_binding_id' => 'exists:smsc_bindings,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSMSCBindingID(): string
    {
        return $this->data['smsc_binding_id']?? '';
    }
}