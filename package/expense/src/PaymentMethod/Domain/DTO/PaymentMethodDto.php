<?php

namespace Epush\Expense\PaymentMethod\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class PaymentMethodDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'payment_method_id' => 'exists:payment_methods,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPaymentMethodID(): string
    {
        return $this->data['payment_method_id']?? '';
    }
}