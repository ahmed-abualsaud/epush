<?php

namespace Epush\Expense\PaymentMethod\App\Service;

use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodDatabaseServiceContract;
use Epush\Expense\PaymentMethod\Infra\Database\Driver\PaymentMethodDatabaseDriverContract;

class PaymentMethodDatabaseService implements PaymentMethodDatabaseServiceContract
{
    public function __construct(

        private PaymentMethodDatabaseDriverContract $paymentMethodDatabaseDriver

    ) {}

    public function listPaymentMethods(): array
    {
        return $this->paymentMethodDatabaseDriver->paymentMethodRepository()->all();
    }

    public function getPaymentMethod(string $paymentMethodID): array
    {
        return $this->paymentMethodDatabaseDriver->paymentMethodRepository()->get($paymentMethodID);
    }

    public function addPaymentMethod(array $paymentMethod): array
    {
        return $this->paymentMethodDatabaseDriver->paymentMethodRepository()->create($paymentMethod);
    }

    public function updatePaymentMethod(string $paymentMethodID, array $data): array
    {
        return $this->paymentMethodDatabaseDriver->paymentMethodRepository()->update($paymentMethodID, $data);
    }

    public function deletePaymentMethod(string $paymentMethodID): bool
    {
        return $this->paymentMethodDatabaseDriver->paymentMethodRepository()->delete($paymentMethodID);
    }
}