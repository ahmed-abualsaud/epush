<?php

namespace Epush\Core\Sales\Domain\UseCase;

use Epush\Core\Sales\Domain\DTO\SalesDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;

class GetSalesUseCase
{
    public function __construct(

        private SalesServiceContract $salesService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SalesDto $salesDto): array
    {
        $this->validationService->validate($salesDto->toArray(), SalesDto::rules());
        return $this->salesService->get($salesDto->getSalesID());
    }
}