<?php

namespace Epush\Expense\Order\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class OrderDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'order_id' => 'exists:orders,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getOrderID(): string
    {
        return $this->data['order_id']?? '';
    }
}