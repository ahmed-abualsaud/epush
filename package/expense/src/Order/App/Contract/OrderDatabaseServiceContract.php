<?php

namespace Epush\Expense\Order\App\Contract;

interface OrderDatabaseServiceContract
{
    public function getOrder(string $orderID): array;

    public function addOrder(array $order): array;

    public function paginateOrders(int $take): array;

    public function getClientOrders(string $userID): array;

    public function getClientLatestOrder(string $userID): array;

    public function updateOrder(string $orderID, array $order): array;
    
    public function getOrdersByID(array $ordersID, int $take = 10): array;

    public function getOrdersByUsersID(array $usersID, int $take = 10): array;

    public function getOrdersByPricelistsID(array $pricelistsID, int $take = 10): array;

    public function getOrdersByPaymentMethodsID(array $paymentMethodsID, int $take = 10): array;

    public function searchOrderColumn(string $column, string $value, int $take = 10): array;
}