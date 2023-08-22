<?php

namespace Epush\Core\Country\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class CountryDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'country_id' => 'exists:countries,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getCountryID(): string
    {
        return $this->data['country_id']?? '';
    }
}