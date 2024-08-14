<?php

namespace Epush\Core\SMSCBinding\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSMSCBindingDto implements DtoContract
{
    private static string $smscBindingID;

    public function __construct(string $smscBindingID, private array $data) 
    {
        self::$smscBindingID = $smscBindingID;
    }

    public static function rules(): array
    {
        return [
            'country_id' => 'string|exists:countries,id',
            'operator_id' => 'string|exists:operators,id',
            'smsc_id' => 'string|exists:smscs,id',
            'default' => 'boolean',
            'length' => 'integer'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['default']) && $this->data['default'] = $this->data['default'] == 'true';
        return $this->data;
    }
}