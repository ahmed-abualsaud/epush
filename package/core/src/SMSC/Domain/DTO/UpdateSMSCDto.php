<?php

namespace Epush\Core\SMSC\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSMSCDto implements DtoContract
{
    private static string $smscID;

    public function __construct(string $smscID, private array $data) 
    {
        self::$smscID = $smscID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:smscs,name,'.self::$smscID.'|string',
            'value' => 'unique:smscs,value,'.self::$smscID.'|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}