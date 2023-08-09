<?php

namespace Epush\Core\Sales\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateSalesDto implements DtoContract
{
    private static string $salesID;

    public function __construct(string $salesID, private array $data) 
    {
        self::$salesID = $salesID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:sales,name,'.self::$salesID,
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}