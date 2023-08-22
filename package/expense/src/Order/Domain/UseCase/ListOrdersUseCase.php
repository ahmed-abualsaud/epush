<?php

namespace Epush\Expense\Order\Domain\UseCase;

use Epush\Expense\Order\Domain\DTO\ListOrdersDto;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListOrdersUseCase
{
    public function __construct(

        private OrderServiceContract $orderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListOrdersDto $listOrdersDto): array
    {
        $this->validationService->validate($listOrdersDto->toArray(), ListOrdersDto::rules());
        return $this->orderService->list($listOrdersDto->getPageSize());
    }
}