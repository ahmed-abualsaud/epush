<?php

namespace Epush\Expense\PaymentMethod\Infra\Database\Repository\Contract;

interface PaymentMethodRepositoryContract
{
    public function all(): array;

    public function get(string $id): array;

    public function create(array $client): array;

    public function update(string $id, array $data): array;

    public function delete(string $id): bool;

    public function getPaymentMethods(array $paymentMethodsID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}