<?php

namespace Epush\Expense\Order\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddOrderDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'credit' => 'required|numeric|min:0',
            'action' => 'required|in:Add,Refund,Deduct',
            'user_id' => 'required|exists:clients,user_id',
            'pricelist_id' => 'required|exists:pricelists,id',
            'payment_method_id' => 'required|exists:payment_methods,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getAction(): string
    {
        return $this->data['action'] ?? null;
    }

    public function getOrder(): array
    {
        return subAssociativeArray([

            'credit',
            'user_id',
            'pricelist_id',
            'payment_method_id'

        ], $this->data);
    }
}