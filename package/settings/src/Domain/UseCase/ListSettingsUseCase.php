<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\Domain\DTO\ListSettingsDto;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSettingsDto $listSettingsDto): array
    {
        $this->validationService->validate($listSettingsDto->toArray(), ListSettingsDto::rules());
        return $this->settingsService->list($listSettingsDto->getPageSize());
    }
}