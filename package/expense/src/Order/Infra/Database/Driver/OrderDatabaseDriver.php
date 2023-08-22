<?php

namespace Epush\Expense\Order\Infra\Database\Driver;

use Epush\Expense\Order\Infra\Database\Repository\Contract\OrderRepositoryContract;

class OrderDatabaseDriver implements OrderDatabaseDriverContract
{
    public function __construct(

        private OrderRepositoryContract $orderRepository

    ) {}

    public function orderRepository(): OrderRepositoryContract
    {
        return $this->orderRepository;
    }
}