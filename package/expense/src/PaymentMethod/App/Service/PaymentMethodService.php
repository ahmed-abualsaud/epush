<?php

namespace Epush\Expense\PaymentMethod\App\Service;

use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodDatabaseServiceContract;

class PaymentMethodService implements PaymentMethodServiceContract
{
    public function __construct(

        private PaymentMethodDatabaseServiceContract $paymentMethodDatabaseService

    ) {}

    public function list(): array
    {
        return $this->paymentMethodDatabaseService->listPaymentMethods();
    }

    public function get(string $paymentMethodID): array
    {
        return $this->paymentMethodDatabaseService->getPaymentMethod($paymentMethodID);
    }

    public function add(array $paymentMethod): array
    {
        return $this->paymentMethodDatabaseService->addPaymentMethod($paymentMethod);
    }

    public function update(string $paymentMethodID, array $data): array
    {
        return $this->paymentMethodDatabaseService->updatePaymentMethod($paymentMethodID, $data);
    }

    public function delete(string $paymentMethodID): bool
    {
        return $this->paymentMethodDatabaseService->deletePaymentMethod($paymentMethodID);
    }

    public function getPaymentMethods(array $paymentMethodsID): array
    {
        return $this->paymentMethodDatabaseService->getPaymentMethods($paymentMethodsID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->paymentMethodDatabaseService->searchPaymentMethodColumn($column, $value, $take);
    }
}