<?php

namespace Epush\Core\Pricelist\Domain\UseCase;

use Epush\Core\Pricelist\Domain\DTO\AddPricelistDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;

class AddPricelistUseCase
{
    public function __construct(

        private PricelistServiceContract $pricelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddPricelistDto $addPricelistDto): array
    {
        $this->validationService->validate($addPricelistDto->toArray(), AddPricelistDto::rules());
        return $this->pricelistService->add($addPricelistDto->toArray());
    }
}