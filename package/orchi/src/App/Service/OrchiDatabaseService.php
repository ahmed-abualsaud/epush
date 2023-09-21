<?php

namespace Epush\Orchi\App\Service;

use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Orchi\Infra\Database\Driver\OrchiDatabaseDriver;

class OrchiDatabaseService implements OrchiDatabaseServiceContract
{
    public function __construct(

        private OrchiDatabaseDriver $orchiDatabaseDriver

    ) {}

    public function getAllAppServices(): array
    {
        return $this->orchiDatabaseDriver->appServiceRepository()->all();
    }

    public function getLocalAppServices(): array
    {
        return $this->orchiDatabaseDriver->appServiceRepository()->getLocalServices();
    }

    public function getRemoteAppServices(): array
    {
        return $this->orchiDatabaseDriver->appServiceRepository()->getRemoteServices();
    }

    public function getAppServiceContexts(string $serviceID): array
    {
        return $this->orchiDatabaseDriver->contextRepository()->getAppServiceContexts($serviceID);
    }

    public function getContextHandleGroups(string $contextID): array
    {
        return $this->orchiDatabaseDriver->handleGroupRepository()->getContextHandleGroups($contextID);
    }

    public function getHandleGroupHandlers(string $handleGroupID): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->getHandleGroupHandlers($handleGroupID);
    }

    public function updateAppService(string $serviceID, array $data): array
    {
        return $this->orchiDatabaseDriver->appServiceRepository()->update($serviceID, $data);
    }

    public function updateContext(string $contextID, array $data): array
    {
        return $this->orchiDatabaseDriver->contextRepository()->update($contextID, $data);
    }

    public function updateHandleGroup(string $handleGroupID, array $data): array
    {
        return $this->orchiDatabaseDriver->handlegroupRepository()->update($handleGroupID, $data);
    }

    public function getHandler(string $handlerID): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->getHandler($handlerID);
    }

    public function getAllHandlers(): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->all();
    }

    public function updateHandler(string $handlerID, array $data): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->update($handlerID, $data);
    }

    public function getHandlers(array $handersID): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->getHandlers($handersID);
    }

    public function getHandlerByEndpoint(string $endpoint): array
    {
        return $this->orchiDatabaseDriver->handlerRepository()->getHandlerByEndpoint($endpoint);
    }
}