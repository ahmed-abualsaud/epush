<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetAuthUserMicroprocess implements MicroprocessContract
{
    public function __construct(

        private CredentialsServiceContract $credentialsService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        return $this->credentialsService->getAuthenticateduser();
    }
}