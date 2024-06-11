<?php

namespace Epush\Expense\Order\Domain\UseCase;

use Epush\Expense\Order\Domain\DTO\SearchOrderDto;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchOrderUseCase
{
    public function __construct(

        private OrderServiceContract $orderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchOrderDto $searchOrderDto): array
    {
        $this->validationService->validate($searchOrderDto->toArray(), SearchOrderDto::rules());
        return $this->orderService->searchColumn(
            $searchOrderDto->getSearchColumn(),
            $searchOrderDto->getSearchValue(),
            $searchOrderDto->getPageSize(),
            $searchOrderDto->getPartnerID()
        );
    }
}