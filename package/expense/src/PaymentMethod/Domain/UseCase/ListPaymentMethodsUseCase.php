<?php

namespace Epush\Expense\PaymentMethod\Domain\UseCase;

use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

class ListPaymentMethodsUseCase
{
    public function __construct(

        private PaymentMethodServiceContract $paymentMethodService

    ) {}

    public function execute(): array
    {
        return $this->paymentMethodService->list();
    }
}