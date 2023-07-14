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

#[Prefix('api/orchi')]
class AppServiceController
{
    #[Get('service')]
    public function listAppServices(ListAppServicesUseCase $listAppServicesUseCase): Response
    {
        return successJSONResponse($listAppServicesUseCase->execute());
    }

    #[Get('service/{service_id}/contexts')]
    public function getAppServiceContexts(AppServiceDto $appServiceDto, GetAppServiceContextsUseCase $getAppServiceContextsUseCase): Response
    {
        return successJSONResponse($getAppServiceContextsUseCase->execute($appServiceDto));
    }

    #[Put('service/{service_id}')]
    public function updateAppService(AppServiceDto $appServiceDto, UpdateAppServiceDto $updateAppServiceDto, UpdateAppServiceUseCase $updateAppServiceUseCase): Response
    {
        return successJSONResponse($updateAppServiceUseCase->execute($appServiceDto, $updateAppServiceDto));
    }
}