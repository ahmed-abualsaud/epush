<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\HandlerDto;
use Epush\Orchi\Domain\DTO\UpdateHandlerDto;
use Epush\Orchi\Domain\UseCase\ListHandlersUseCase;
use Epush\Orchi\Domain\UseCase\UpdateHandlerUseCase;

#[Prefix('api/orchi/handler')]
class HandlerController
{
    #[Get('/')]
    public function listHandlers(ListHandlersUseCase $listHandlersUseCase): Response
    {
        return successJSONResponse($listHandlersUseCase->execute());
    }

    #[Put('{handler_id}')]
    public function updateHandler(HandlerDto $handlerDto, UpdateHandlerDto $updateHandlerDto, UpdateHandlerUseCase $updateHandlerUseCase): Response
    {
        return successJSONResponse($updateHandlerUseCase->execute($handlerDto, $updateHandlerDto));
    }
}