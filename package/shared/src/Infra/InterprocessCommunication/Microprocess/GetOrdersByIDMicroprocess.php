<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetOrdersByIDMicroprocess implements MicroprocessContract
{
    public function __construct(

        private OrderServiceContract $orderService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$ordersID, $take] = $data;
        return $this->orderService->getOrdersByID($ordersID, $take);
    }
}