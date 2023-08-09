<?php

namespace Epush\Core\Pricelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdatePricelistDto implements DtoContract
{
    private static string $pricelistID;

    public function __construct(string $pricelistID, private array $data) 
    {
        self::$pricelistID = $pricelistID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:pricelists,name,'.self::$pricelistID,
            'price' => 'numeric|min:0'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}