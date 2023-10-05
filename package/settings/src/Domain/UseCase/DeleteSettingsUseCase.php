<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Settings\Domain\DTO\SettingsDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SettingsDto $settingsDto): bool
    {
        $this->validationService->validate($settingsDto->toArray(), SettingsDto::rules());
        return $this->settingsService->delete($settingsDto->getSettingsID());
    }
}