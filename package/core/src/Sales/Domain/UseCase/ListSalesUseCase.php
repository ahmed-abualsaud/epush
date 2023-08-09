<?php

namespace Epush\Core\Sales\Domain\UseCase;

use Epush\Core\Sales\App\Contract\SalesServiceContract;

class ListSalesUseCase
{
    public function __construct(

        private SalesServiceContract $salesService

    ) {}

    public function execute(): array
    {
        return $this->salesService->list();
    }
}