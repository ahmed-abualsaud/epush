<?php

namespace Epush\Core\SMSCBinding\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSMSCBindingDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'country_id' => 'required|string|exists:countries,id',
            'operator_id' => 'required|string|exists:operators,id',
            'smsc_id' => 'required|string|exists:smscs,id',
            'default' => 'boolean',
        ];
    }


    public function toArray(): array
    {
        ! empty($this->data['default']) && $this->data['default'] = $this->data['default'] == 'true';
        return $this->data;
    }
}