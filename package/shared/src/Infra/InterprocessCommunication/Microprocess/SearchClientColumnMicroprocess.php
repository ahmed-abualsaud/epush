<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SearchClientColumnMicroprocess implements MicroprocessContract
{
    public function __construct(

        private ClientServiceContract $clientService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$column, $value, $searchClient, $take] = $data;
        $partnerID = count($data) > 4 ? $data[4] : null;
        return $this->clientService->searchColumn($column, $value, $searchClient, $take, $partnerID);
    }
}