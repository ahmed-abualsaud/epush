<?php

namespace Epush\Expense\Order\Domain\UseCase;

use Epush\Expense\Order\Domain\DTO\OrderDto;
use Epush\Expense\Order\Domain\DTO\UpdateOrderDto;

use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateOrderUseCase
{
    public function __construct(

        private OrderServiceContract $orderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OrderDto $orderDto, UpdateOrderDto $updateOrderDto): array
    {
        $this->validationService->validate($orderDto->toArray(), OrderDto::rules());
        $this->validationService->validate($updateOrderDto->toArray(), UpdateOrderDto::rules());
        return $this->orderService->update($orderDto->getOrderID(), $updateOrderDto->toArray());
    }
}