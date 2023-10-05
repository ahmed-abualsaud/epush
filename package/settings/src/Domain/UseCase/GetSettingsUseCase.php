<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\Domain\DTO\SettingsDto;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SettingsDto $settingsDto): array
    {
        $this->validationService->validate($settingsDto->toArray(), SettingsDto::rules());
        return $this->settingsService->get($settingsDto->getSettingsID());
    }
}