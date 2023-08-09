<?php

namespace Epush\Core\Sales\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SalesDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sales_id' => 'exists:sales,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSalesID(): string
    {
        return $this->data['sales_id']?? '';
    }
}