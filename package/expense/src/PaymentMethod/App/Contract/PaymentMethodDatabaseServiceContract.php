<?php

namespace Epush\Expense\PaymentMethod\App\Contract;

interface PaymentMethodDatabaseServiceContract
{
    public function listPaymentMethods(): array;

    public function getPaymentMethod(string $paymentMethodID): array;

    public function addPaymentMethod(array $paymentMethod): array;

    public function updatePaymentMethod(string $paymentMethodID, array $data): array;

    public function deletePaymentMethod(string $paymentMethodID): bool;
}