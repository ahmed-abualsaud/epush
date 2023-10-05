<?php

namespace Epush\Settings\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Settings\Domain\DTO\SettingsDto;
use Epush\Settings\Domain\DTO\AddSettingsDto;
use Epush\Settings\Domain\DTO\ListSettingsDto;
use Epush\Settings\Domain\DTO\SearchSettingsDto;
use Epush\Settings\Domain\DTO\UpdateSettingsDto;

use Epush\Settings\Domain\UseCase\GetSettingsUseCase;
use Epush\Settings\Domain\UseCase\AddSettingsUseCase;
use Epush\Settings\Domain\UseCase\ListSettingsUseCase;
use Epush\Settings\Domain\UseCase\DeleteSettingsUseCase;
use Epush\Settings\Domain\UseCase\SearchSettingsUseCase;
use Epush\Settings\Domain\UseCase\UpdateSettingsUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/settings')]
class SettingsController
{
    #[Get('/')]
    public function listSettings(ListSettingsDto $listSettingsDto, ListSettingsUseCase $listSettingsUseCase): Response
    {
        return successJSONResponse($listSettingsUseCase->execute($listSettingsDto));
    }

    #[Post('/')]
    public function addSettings(AddSettingsDto $addSettingsDto, AddSettingsUseCase $addSettingsUseCase): Response
    {
        return successJSONResponse($addSettingsUseCase->execute($addSettingsDto));
    }

    #[Get('{settings_id}')]
    public function getSettings(SettingsDto $settingsDto, GetSettingsUseCase $getSettingsUseCase): Response
    {
        return successJSONResponse($getSettingsUseCase->execute($settingsDto));
    }

    #[Put('{settings_id}')]
    public function updateSettings(SettingsDto $settingsDto, UpdateSettingsDto $updateSettingsDto, UpdateSettingsUseCase $updateSettingsUseCase): Response
    {
        return successJSONResponse($updateSettingsUseCase->execute($settingsDto, $updateSettingsDto));
    }

    #[Delete('{settings_id}')]
    public function deleteSettings(SettingsDto $settingsDto, DeleteSettingsUseCase $deleteSettingsUseCase): Response
    {
        return successJSONResponse($deleteSettingsUseCase->execute($settingsDto));
    }

    #[Post('/search')]
    public function searchSettingsColumn(SearchSettingsDto $searchSettingsDto, SearchSettingsUseCase $searchSettingsUseCase): Response
    {
        return successJSONResponse($searchSettingsUseCase->execute($searchSettingsDto));
    }
}