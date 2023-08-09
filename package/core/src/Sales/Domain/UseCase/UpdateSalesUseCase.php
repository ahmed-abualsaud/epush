<?php

namespace Epush\Core\Sales\Domain\UseCase;

use Epush\Core\Sales\Domain\DTO\SalesDto;
use Epush\Core\Sales\Domain\DTO\UpdateSalesDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;

class UpdateSalesUseCase
{
    public function __construct(

        private SalesServiceContract $salesService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SalesDto $salesDto, UpdateSalesDto $updateSalesDto): array
    {
        $this->validationService->validate($salesDto->toArray(), SalesDto::rules());
        $this->validationService->validate($updateSalesDto->toArray(), UpdateSalesDto::rules());
        return $this->salesService->update($salesDto->getSalesID(), $updateSalesDto->toArray());
    }
}