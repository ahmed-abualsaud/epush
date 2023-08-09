<?php

namespace Epush\Expense\PaymentMethod\Domain\UseCase;

use Epush\Expense\PaymentMethod\Domain\DTO\PaymentMethodDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Expense\PaymentMethod\Domain\DTO\UpdatePaymentMethodDto;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;

class UpdatePaymentMethodUseCase
{
    public function __construct(

        private PaymentMethodServiceContract $paymentMethodService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PaymentMethodDto $paymentMethodDto, UpdatePaymentMethodDto $updatePaymentMethodDto): array
    {
        $this->validationService->validate($paymentMethodDto->toArray(), PaymentMethodDto::rules());
        $this->validationService->validate($updatePaymentMethodDto->toArray(), UpdatePaymentMethodDto::rules());
        return $this->paymentMethodService->update($paymentMethodDto->getPaymentMethodID(), $updatePaymentMethodDto->toArray());
    }
}