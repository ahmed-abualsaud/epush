<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Pricelist\App\Contract\PricelistServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientLatestOrderMicroprocess implements MicroprocessContract
{
    public function __construct(

        private OrderDatabaseServiceContract $orderService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        $latestOrder = $this->orderService->getClientLatestOrder($userID);
        $latestOrder['pricelist'] = $latestOrder? app(PricelistServiceContract::class)->get($latestOrder['pricelist_id']) : null;
        return $latestOrder;
    }
}