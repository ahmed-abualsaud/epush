<?php

namespace Epush\Expense\Order\Infra\Database\Repository\Contract;

interface OrderRepositoryContract
{
    public function all(int $take): array;

    public function get(string $orderID): array;

    public function create(array $order): array;

    public function getClientOrders(string $userID): array;

    public function getOrdersByUsersID(array $usersID, int $take = 10): array;

    public function getOrdersByPricelistsID(array $pricelistsID, int $take = 10): array;

    public function getOrdersByPaymentMethodsID(array $paymentMethodsID, int $take = 10): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}