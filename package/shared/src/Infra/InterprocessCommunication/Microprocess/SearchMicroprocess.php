<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Search\App\Contract\SearchServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SearchMicroprocess implements MicroprocessContract
{
    public function __construct(

        private SearchServiceContract $searchService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$query] = $data;
        return $this->searchService->search($query);
    }
}