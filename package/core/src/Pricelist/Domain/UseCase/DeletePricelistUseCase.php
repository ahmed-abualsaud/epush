<?php

namespace Epush\Core\Pricelist\Domain\UseCase;

use Epush\Core\Pricelist\Domain\DTO\PricelistDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class DeletePricelistUseCase
{
    public function __construct(

        private PricelistServiceContract $pricelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PricelistDto $pricelistDto): bool
    {
        $this->validationService->validate($pricelistDto->toArray(), PricelistDto::rules());
        return $this->pricelistService->delete($pricelistDto->getPricelistID());
    }
}