<?php

namespace Epush\Orchi\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Response;

use Epush\Orchi\Domain\DTO\AppServiceDto;
use Epush\Orchi\Domain\DTO\UpdateAppServiceDto;

use Epush\Orchi\Domain\UseCase\ListAppServicesUseCase;
use Epush\Orchi\Domain\UseCase\UpdateAppServiceUseCase;
use Epush\Orchi\Domain\UseCase\GetAppServiceContextsUseCase;

#[Prefix('api/orchi/service')]
class AppServiceController
{
    #[Get('/')]
    public function listAppServices(ListAppServicesUseCase $listAppServicesUseCase): Response
    {
        return jsonResponse($listAppServicesUseCase->execute());
    }

    #[Get('{service_id}/contexts')]
    public function getAppServiceContexts(AppServiceDto $appServiceDto, GetAppServiceContextsUseCase $getAppServiceContextsUseCase): Response
    {
        return jsonResponse($getAppServiceContextsUseCase->execute($appServiceDto));
    }

    #[Put('{service_id}')]
    public function updateAppService(AppServiceDto $appServiceDto, UpdateAppServiceDto $updateAppServiceDto, UpdateAppServiceUseCase $updateAppServiceUseCase): Response
    {
        return jsonResponse($updateAppServiceUseCase->execute($appServiceDto, $updateAppServiceDto));
    }
}