<?php

namespace Epush\Core\BusinessField\Present\Http\Controller;

use Epush\Core\BusinessField\Domain\DTO\BusinessFieldDto;
use Epush\Core\BusinessField\Domain\DTO\AddBusinessFieldDto;
use Epush\Core\BusinessField\Domain\DTO\UpdateBusinessFieldDto;

use Epush\Core\BusinessField\Domain\UseCase\AddBusinessFieldUseCase;
use Epush\Core\BusinessField\Domain\UseCase\GetBusinessFieldUseCase;
use Epush\Core\BusinessField\Domain\UseCase\ListBusinessFieldsUseCase;
use Epush\Core\BusinessField\Domain\UseCase\DeleteBusinessFieldUseCase;
use Epush\Core\BusinessField\Domain\UseCase\UpdateBusinessFieldUseCase;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/business-field')]
class BusinessFieldController
{
    #[Get('/')]
    public function listBusinessFields(ListBusinessFieldsUseCase $listBusinessFieldsUseCase): Response
    {
        return successJSONResponse($listBusinessFieldsUseCase->execute());
    }

    #[Post('/')]
    public function addBusinessField(AddBusinessFieldDto $addBusinessFieldDto, AddBusinessFieldUseCase $addBusinessFieldUseCase): Response
    {
        return successJSONResponse($addBusinessFieldUseCase->execute($addBusinessFieldDto));
    }

    #[Get('{business_field_id}')]
    public function getBusinessField(BusinessFieldDto $businessfieldDto, GetBusinessFieldUseCase $getBusinessFieldUseCase): Response
    {
        return successJSONResponse($getBusinessFieldUseCase->execute($businessfieldDto));
    }

    #[Put('{business_field_id}')]
    public function updateBusinessField(BusinessFieldDto $businessfieldDto, UpdateBusinessFieldDto $updateBusinessFieldDto, UpdateBusinessFieldUseCase $updateBusinessFieldUseCase): Response
    {
        return successJSONResponse($updateBusinessFieldUseCase->execute($businessfieldDto, $updateBusinessFieldDto));
    }

    #[Delete('{business_field_id}')]
    public function deleteBusinessField(BusinessFieldDto $businessfieldDto, DeleteBusinessFieldUseCase $deleteBusinessFieldUseCase): Response
    {
        return successJSONResponse($deleteBusinessFieldUseCase->execute($businessfieldDto));
    }
}