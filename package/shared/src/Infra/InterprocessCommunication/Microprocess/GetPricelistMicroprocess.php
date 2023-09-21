<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetPricelistMicroprocess implements MicroprocessContract
{
    public function __construct(

        private PricelistServiceContract $pricelistService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$pricelistID] = $data;
        return $this->pricelistService->get($pricelistID);
    }
}