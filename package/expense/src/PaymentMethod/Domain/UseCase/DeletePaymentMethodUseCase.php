<?php

namespace Epush\Expense\PaymentMethod\Domain\UseCase;

use Epush\Expense\PaymentMethod\Domain\DTO\PaymentMethodDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

class DeletePaymentMethodUseCase
{
    public function __construct(

        private PaymentMethodServiceContract $paymentMethodService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PaymentMethodDto $paymentMethodDto): bool
    {
        $this->validationService->validate($paymentMethodDto->toArray(), PaymentMethodDto::rules());
        return $this->paymentMethodService->delete($paymentMethodDto->getPaymentMethodID());
    }
}