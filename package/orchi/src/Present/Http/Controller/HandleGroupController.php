<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\HandleGroupDto;
use Epush\Orchi\Domain\DTO\UpdateHandleGroupDto;
use Epush\Orchi\Domain\UseCase\UpdateHandleGroupUseCase;
use Epush\Orchi\Domain\UseCase\GetHandleGroupHandlersUseCase;

#[Prefix('api/orchi/handle-group')]
class HandleGroupController
{
    #[Get('{handle_group_id}/handlers')]
    public function getHandleGroupHandlers(HandleGroupDto $handleGroupDto, GetHandleGroupHandlersUseCase $getHandleGroupHandlersUseCase): Response
    {
        return successJSONResponse($getHandleGroupHandlersUseCase->execute($handleGroupDto));
    }

    #[Put('{handle_group_id}')]
    public function updateHandleGroup(HandleGroupDto $handleGroupDto, UpdateHandleGroupDto $updateHandleGroupDto, UpdateHandleGroupUseCase $updateHandleGroupUseCase): Response
    {
        return successJSONResponse($updateHandleGroupUseCase->execute($handleGroupDto, $updateHandleGroupDto));
    }
}