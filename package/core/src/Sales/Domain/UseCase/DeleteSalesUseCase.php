<?php

namespace Epush\Core\Sales\Domain\UseCase;

use Epush\Core\Sales\Domain\DTO\SalesDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;

class DeleteSalesUseCase
{
    public function __construct(

        private SalesServiceContract $salesService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SalesDto $salesDto): bool
    {
        $this->validationService->validate($salesDto->toArray(), SalesDto::rules());
        return $this->salesService->delete($salesDto->getSalesID());
    }
}