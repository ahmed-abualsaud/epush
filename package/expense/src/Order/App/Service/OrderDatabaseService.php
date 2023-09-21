<?php

namespace Epush\Expense\Order\App\Service;

use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Expense\Order\Infra\Database\Driver\OrderDatabaseDriverContract;

class OrderDatabaseService implements OrderDatabaseServiceContract
{
    public function __construct(

        private OrderDatabaseDriverContract $orderDatabaseDriver

    ) {}

    public function getOrder(string $orderID): array
    {
        return $this->orderDatabaseDriver->orderRepository()->get($orderID);
    }

    public function paginateOrders(int $take): array
    {
        return $this->orderDatabaseDriver->orderRepository()->all($take);
    }

    public function addOrder(array $order): array
    {
        return $this->orderDatabaseDriver->orderRepository()->create($order);
    }

    public function updateOrder(string $orderID, array $order): array
    {
        return $this->orderDatabaseDriver->orderRepository()->update($orderID, $order);
    }

    public function getClientOrders(string $userID): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getClientOrders($userID);
    }

    public function getClientLatestOrder(string $userID): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getClientLatestOrder($userID);
    }

    public function getOrdersByID(array $ordersID, int $take = 10): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getOrdersByID($ordersID, $take);
    }

    public function getOrdersByUsersID(array $usersID, int $take = 10): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getOrdersByUsersID($usersID, $take);
    }

    public function getOrdersByPricelistsID(array $pricelistsID, int $take = 10): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getOrdersByPricelistsID($pricelistsID, $take);
    }

    public function getOrdersByPaymentMethodsID(array $paymentMethodsID, int $take = 10): array
    {
        return $this->orderDatabaseDriver->orderRepository()->getOrdersByPaymentMethodsID($paymentMethodsID, $take);
    }

    public function searchOrderColumn(string $column, string $value, int $take = 10): array
    {
        return $this->orderDatabaseDriver->orderRepository()->searchColumn($column, $value, $take);
    }
}