<?php

namespace Epush\Core\Country\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateCountryDto implements DtoContract
{
    private static string $countryID;

    public function __construct(string $countryID, private array $data) 
    {
        self::$countryID = $countryID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'unique:countries,name,'.self::$countryID.'|string',
            'code' => 'string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}