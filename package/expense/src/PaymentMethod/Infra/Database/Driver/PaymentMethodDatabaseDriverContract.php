<?php

namespace Epush\Expense\PaymentMethod\Infra\Database\Driver;

use Epush\Expense\PaymentMethod\Infra\Database\Repository\Contract\PaymentMethodRepositoryContract;

interface PaymentMethodDatabaseDriverContract
{
    public function paymentMethodRepository(): PaymentMethodRepositoryContract;
}