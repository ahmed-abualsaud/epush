<?php

namespace Epush\Expense\PaymentMethod\Domain\UseCase;

use Epush\Expense\PaymentMethod\Domain\DTO\AddPaymentMethodDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

class AddPaymentMethodUseCase
{
    public function __construct(

        private PaymentMethodServiceContract $paymentMethodService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddPaymentMethodDto $addPaymentMethodDto): array
    {
        $this->validationService->validate($addPaymentMethodDto->toArray(), AddPaymentMethodDto::rules());
        return $this->paymentMethodService->add($addPaymentMethodDto->toArray());
    }
}