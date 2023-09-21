<?php

namespace Epush\Expense\Order\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateOrderDto implements DtoContract
{
    private static string $orderID;

    public function __construct(string $orderID, private array $data) 
    {
        self::$orderID = $orderID;
    }

    public static function rules(): array
    {
        return [
            'payment_method_id' => 'exists:payment_methods,id',
            'collection_date' => 'date'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}