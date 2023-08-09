<?php

namespace Epush\Core\Pricelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class PricelistDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'pricelist_id' => 'exists:pricelists,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPricelistID(): string
    {
        return $this->data['pricelist_id']?? '';
    }
}