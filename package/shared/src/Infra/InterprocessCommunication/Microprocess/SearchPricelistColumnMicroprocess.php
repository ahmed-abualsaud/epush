<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SearchPricelistColumnMicroprocess implements MicroprocessContract
{
    public function __construct(

        private PricelistServiceContract $pricelistService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$column, $value, $take] = $data;
        return $this->pricelistService->searchColumn($column, $value, $take);
    }
}