<?php

namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\ExpenseServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

class ExpenseService implements ExpenseServiceContract
{
    public function __construct(

        private OrderDatabaseServiceContract $orderService,
        private PaymentMethodServiceContract $paymentMethodService

    ) {}

    public function getClientOrders(string $userID): array
    {
        return $this->orderService->getClientOrders($userID);
    }
    
    public function getPaymentMethods(array $paymentMethodsID): array
    {
        return $this->paymentMethodService->getPaymentMethods($paymentMethodsID);
    }

    public function searchPaymentMehtodColumn(string $column, string $value, int $take = 10): array
    {
        return $this->paymentMethodService->searchColumn($column, $value, $take);
    }
}