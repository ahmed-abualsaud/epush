<?php

namespace Epush\Expense\PaymentMethod\App\Contract;

interface PaymentMethodServiceContract
{
    public function list(): array;

    public function get(string $paymentMethodID): array;

    public function add(array $paymentMethod): array;

    public function update(string $paymentMethodID, array $data): array;

    public function delete(string $paymentMethodID): bool;

    public function getPaymentMethods(array $paymentMethodsID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}