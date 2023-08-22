<?php

namespace Epush\Shared\App\Contract;

interface ExpenseServiceContract
{
    public function getPaymentMethods(array $paymentMethodsID): array;

    public function getClientOrders(string $userID): array;

    public function searchPaymentMehtodColumn(string $column, string $value, int $take = 10): array;
}