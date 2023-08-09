<?php

namespace Epush\Core\Pricelist\Domain\UseCase;

use Epush\Core\Pricelist\Domain\DTO\PricelistDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class GetPricelistUseCase
{
    public function __construct(

        private PricelistServiceContract $pricelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PricelistDto $pricelistDto): array
    {
        $this->validationService->validate($pricelistDto->toArray(), PricelistDto::rules());
        return $this->pricelistService->get($pricelistDto->getPricelistID());
    }
}