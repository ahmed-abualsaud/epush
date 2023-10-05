<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\Domain\DTO\SettingsDto;
use Epush\Settings\Domain\DTO\UpdateSettingsDto;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SettingsDto $settingsDto, UpdateSettingsDto $updateSettingsDto): array
    {
        $this->validationService->validate($settingsDto->toArray(), SettingsDto::rules());
        $this->validationService->validate($updateSettingsDto->toArray(), UpdateSettingsDto::rules());
        return $this->settingsService->update($settingsDto->getSettingsID(), $updateSettingsDto->toArray());
    }
}