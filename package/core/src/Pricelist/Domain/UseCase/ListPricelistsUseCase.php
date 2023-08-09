<?php

namespace Epush\Core\Pricelist\Domain\UseCase;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class ListPricelistsUseCase
{
    public function __construct(

        private PricelistServiceContract $pricelistService

    ) {}

    public function execute(): array
    {
        return $this->pricelistService->list();
    }
}