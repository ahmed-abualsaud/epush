<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Sales\App\Contract\SalesServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SearchSalesColumnMicroprocess implements MicroprocessContract
{
    public function __construct(

        private SalesServiceContract $salesService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$column, $value, $take] = $data;
        return $this->salesService->searchColumn($column, $value, $take);
    }
}