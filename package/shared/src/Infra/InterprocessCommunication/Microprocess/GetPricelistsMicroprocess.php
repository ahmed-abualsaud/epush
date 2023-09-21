<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetPricelistsMicroprocess implements MicroprocessContract
{
    public function __construct(

        private PricelistServiceContract $pricelistService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$pricelistsID] = $data;
        return $this->pricelistService->getPricelists($pricelistsID);
    }
}