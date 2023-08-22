<?php

namespace Epush\Expense\Order\Domain\UseCase;

use Epush\Expense\Order\Domain\DTO\AddOrderDto;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddOrderUseCase
{
    public function __construct(

        private OrderServiceContract $orderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddOrderDto $addOrderDto): array
    {
        $this->validationService->validate($addOrderDto->toArray(), AddOrderDto::rules());
        return $this->orderService->add($addOrderDto->getAction(), $addOrderDto->getOrder());
    }
}