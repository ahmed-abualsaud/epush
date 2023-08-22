<?php

namespace Epush\Core\SMSC\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSMSCDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:smscs,name',
            'value' => 'required|string|unique:smscs,value'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}