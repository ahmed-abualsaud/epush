<?php

namespace Epush\Expense\PaymentMethod\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddPaymentMethodDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string|unique:payment_methods',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}