<?php

namespace Epush\Core\Sales\Domain\UseCase;

use Epush\Core\Sales\Domain\DTO\AddSalesDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Sales\App\Contract\SalesServiceContract;

class AddSalesUseCase
{
    public function __construct(

        private SalesServiceContract $salesService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSalesDto $addSalesDto): array
    {
        $this->validationService->validate($addSalesDto->toArray(), AddSalesDto::rules());
        return $this->salesService->add($addSalesDto->toArray());
    }
}