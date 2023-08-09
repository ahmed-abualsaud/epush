<?php

namespace Epush\Core\Pricelist\Domain\UseCase;

use Epush\Core\Pricelist\Domain\DTO\PricelistDto;
use Epush\Core\Pricelist\Domain\DTO\UpdatePricelistDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class UpdatePricelistUseCase
{
    public function __construct(

        private PricelistServiceContract $pricelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PricelistDto $pricelistDto, UpdatePricelistDto $updatePricelistDto): array
    {
        $this->validationService->validate($pricelistDto->toArray(), PricelistDto::rules());
        $this->validationService->validate($updatePricelistDto->toArray(), UpdatePricelistDto::rules());
        return $this->pricelistService->update($pricelistDto->getPricelistID(), $updatePricelistDto->toArray());
    }
}