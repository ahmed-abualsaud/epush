<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\HandlerDto;
use Epush\Orchi\Domain\DTO\UpdateHandlerDto;
use Epush\Orchi\Domain\UseCase\UpdateHandlerUseCase;

#[Prefix('api/orchi')]
class HandlerController
{
    #[Put('handler/{handler_id}')]
    public function updateHandler(HandlerDto $handlerDto, UpdateHandlerDto $updateHandlerDto, UpdateHandlerUseCase $updateHandlerUseCase): Response
    {
        return successJSONResponse($updateHandlerUseCase->execute($handlerDto, $updateHandlerDto));
    }
}