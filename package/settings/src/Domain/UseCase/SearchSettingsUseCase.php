<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\Domain\DTO\SearchSettingsDto;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSettingsDto $searchSettingsDto): array
    {
        $this->validationService->validate($searchSettingsDto->toArray(), SearchSettingsDto::rules());
        return $this->settingsService->searchColumn(
            $searchSettingsDto->getSearchColumn(),
            $searchSettingsDto->getSearchValue(),
            $searchSettingsDto->getPageSize()
        );
    }
}