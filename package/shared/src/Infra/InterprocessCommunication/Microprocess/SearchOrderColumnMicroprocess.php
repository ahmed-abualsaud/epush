<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class SearchOrderColumnMicroprocess implements MicroprocessContract
{
    public function __construct(

        private OrderServiceContract $orderService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$column, $value, $take] = $data;
        return $this->orderService->searchColumn($column, $value, $take);
    }
}