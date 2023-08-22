<?php

namespace Epush\Core\Country\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddCountryDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:countries,name',
            'code' => 'required|string'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}