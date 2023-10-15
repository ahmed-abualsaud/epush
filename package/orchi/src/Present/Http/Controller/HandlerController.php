<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\HandlerDto;
use Epush\Orchi\Domain\DTO\ListHandlersDto;
use Epush\Orchi\Domain\DTO\SearchHandlerDto;
use Epush\Orchi\Domain\DTO\UpdateHandlerDto;

use Epush\Orchi\Domain\UseCase\ListHandlersUseCase;
use Epush\Orchi\Domain\UseCase\SearchHandlerUseCase;
use Epush\Orchi\Domain\UseCase\UpdateHandlerUseCase;

#[Prefix('api/orchi/handler')]
class HandlerController
{
    #[Get('/')]
    public function listHandlers(ListHandlersDto $listHandlersDto, ListHandlersUseCase $listHandlersUseCase): Response
    {
        return successJSONResponse($listHandlersUseCase->execute($listHandlersDto));
    }

    #[Put('{handler_id}')]
    public function updateHandler(HandlerDto $handlerDto, UpdateHandlerDto $updateHandlerDto, UpdateHandlerUseCase $updateHandlerUseCase): Response
    {
        return successJSONResponse($updateHandlerUseCase->execute($handlerDto, $updateHandlerDto));
    }

    #[Post('/search')]
    public function searchHandlerColumn(SearchHandlerDto $searchHandlerDto, SearchHandlerUseCase $searchHandlerUseCase): Response
    {
        return successJSONResponse($searchHandlerUseCase->execute($searchHandlerDto));
    }
}