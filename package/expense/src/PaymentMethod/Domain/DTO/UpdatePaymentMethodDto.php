<?php

namespace Epush\Expense\PaymentMethod\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdatePaymentMethodDto implements DtoContract
{
    private static string $paymentMethodID;

    public function __construct(string $paymentMethodID, private array $data) 
    {
        self::$paymentMethodID = $paymentMethodID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:payment_methods,name,'.self::$paymentMethodID,
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}