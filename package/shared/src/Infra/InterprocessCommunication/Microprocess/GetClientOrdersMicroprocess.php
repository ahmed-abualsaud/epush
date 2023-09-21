<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientOrdersMicroprocess implements MicroprocessContract
{
    public function __construct(

        private OrderDatabaseServiceContract $orderService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        return $this->orderService->getClientOrders($userID);
    }
}