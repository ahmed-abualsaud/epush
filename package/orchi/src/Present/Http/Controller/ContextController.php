<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\ContextDto;
use Epush\Orchi\Domain\DTO\UpdateContextDto;

use Epush\Orchi\Domain\UseCase\UpdateContextUseCase;
use Epush\Orchi\Domain\UseCase\GetContextHandleGroupsUseCase;

#[Prefix('api/orchi/context')]
class ContextController
{
    #[Get('{context_id}/handle-groups')]
    public function getContextHandleGroups(ContextDto $appServiceDto, GetContextHandleGroupsUseCase $getContextHandleGroupsUseCase): Response
    {
        return successJSONResponse($getContextHandleGroupsUseCase->execute($appServiceDto));
    }

    #[Put('{context_id}')]
    public function updateContext(ContextDto $contextDto, UpdateContextDto $updateContextDto, UpdateContextUseCase $updateContextUseCase): Response
    {
        return successJSONResponse($updateContextUseCase->execute($contextDto, $updateContextDto));
    }
}