<?php

namespace Epush\Expense\Order\Infra\Database\Driver;

use Epush\Expense\Order\Infra\Database\Repository\Contract\OrderRepositoryContract;

interface OrderDatabaseDriverContract
{
    public function orderRepository(): OrderRepositoryContract;
}