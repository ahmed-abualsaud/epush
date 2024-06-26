<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SearchUserColumnMicroprocess implements MicroprocessContract
{
    public function __construct(

        private UserServiceContract $userService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$column, $value, $take, $usersID, $partnerID] = $data;
        return $this->userService->searchColumn($column, $value, $take, $usersID, $partnerID);
    }
}