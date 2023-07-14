<?php

namespace Epush\Orchi\App\Contract;

interface OrchiDatabaseServiceContract
{
    public function getAllAppServices(): array;

    public function getLocalAppServices(): array;

    public function getRemoteAppServices(): array;

    public function getAppServiceContexts(string $serviceID): array;

    public function getContextHandleGroups(string $contextID): array;

    public function getHandleGroupHandlers(string $handleGroupID): array;

    public function updateAppService(string $serviceID, array $data): array;

    public function updateContext(string $contextID, array $data): array;

    public function updateHandleGroup(string $handleGroupID, array $data): array;

    public function updateHandler(string $handlerID, array $data): array;

    public function getHandlers(array $handersID): array;
}