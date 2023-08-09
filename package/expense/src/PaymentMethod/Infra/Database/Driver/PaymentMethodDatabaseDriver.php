<?php

namespace Epush\Expense\PaymentMethod\Infra\Database\Driver;

use Epush\Expense\PaymentMethod\Infra\Database\Repository\Contract\PaymentMethodRepositoryContract;

class PaymentMethodDatabaseDriver implements PaymentMethodDatabaseDriverContract
{
    public function __construct(

        private PaymentMethodRepositoryContract $paymentMethodRepository

    ) {}

    public function paymentMethodRepository(): PaymentMethodRepositoryContract
    {
        return $this->paymentMethodRepository;
    }
}