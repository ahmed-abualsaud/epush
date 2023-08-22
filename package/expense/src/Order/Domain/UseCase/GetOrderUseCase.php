<?php

namespace Epush\Expense\Order\Domain\UseCase;

use Epush\Expense\Order\Domain\DTO\OrderDto;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetOrderUseCase
{
    public function __construct(

        private OrderServiceContract $orderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OrderDto $orderDto): array
    {
        $this->validationService->validate($orderDto->toArray(), OrderDto::rules());
        return $this->orderService->get($orderDto->getOrderID());
    }
}