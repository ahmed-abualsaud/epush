<?php

namespace Epush\Expense\PaymentMethod\Present\Http\Controller;

use Epush\Expense\PaymentMethod\Domain\DTO\PaymentMethodDto;
use Epush\Expense\PaymentMethod\Domain\DTO\AddPaymentMethodDto;
use Epush\Expense\PaymentMethod\Domain\DTO\UpdatePaymentMethodDto;

use Epush\Expense\PaymentMethod\Domain\UseCase\AddPaymentMethodUseCase;
use Epush\Expense\PaymentMethod\Domain\UseCase\GetPaymentMethodUseCase;
use Epush\Expense\PaymentMethod\Domain\UseCase\ListPaymentMethodsUseCase;
use Epush\Expense\PaymentMethod\Domain\UseCase\DeletePaymentMethodUseCase;
use Epush\Expense\PaymentMethod\Domain\UseCase\UpdatePaymentMethodUseCase;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/expense/payment-method')]
class PaymentMethodController
{
    #[Get('/')]
    public function listPaymentMethods(ListPaymentMethodsUseCase $listPaymentMethodsUseCase): Response
    {
        return successJSONResponse($listPaymentMethodsUseCase->execute());
    }

    #[Post('/')]
    public function addPaymentMethod(AddPaymentMethodDto $addPaymentMethodDto, AddPaymentMethodUseCase $addPaymentMethodUseCase): Response
    {
        return successJSONResponse($addPaymentMethodUseCase->execute($addPaymentMethodDto));
    }

    #[Get('{payment_method_id}')]
    public function getPaymentMethod(PaymentMethodDto $paymentMethodDto, GetPaymentMethodUseCase $getPaymentMethodUseCase): Response
    {
        return successJSONResponse($getPaymentMethodUseCase->execute($paymentMethodDto));
    }

    #[Put('{payment_method_id}')]
    public function updatePaymentMethod(PaymentMethodDto $paymentMethodDto, UpdatePaymentMethodDto $updatePaymentMethodDto, UpdatePaymentMethodUseCase $updatePaymentMethodUseCase): Response
    {
        return successJSONResponse($updatePaymentMethodUseCase->execute($paymentMethodDto, $updatePaymentMethodDto));
    }

    #[Delete('{payment_method_id}')]
    public function deletePaymentMethod(PaymentMethodDto $paymentMethodDto, DeletePaymentMethodUseCase $deletePaymentMethodUseCase): Response
    {
        return successJSONResponse($deletePaymentMethodUseCase->execute($paymentMethodDto));
    }
}