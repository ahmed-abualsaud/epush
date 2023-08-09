<?php

namespace Epush\Core\Pricelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddPricelistDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:pricelists',
            'price' => 'required|numeric|min:0'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}