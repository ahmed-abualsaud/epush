<?php

namespace Epush\Settings\Domain\UseCase;

use Epush\Settings\Domain\DTO\AddSettingsDto;
use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddSettingsUseCase
{
    public function __construct(

        private SettingsServiceContract $settingsService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddSettingsDto $addSettingsDto): array
    {
        $this->validationService->validate($addSettingsDto->toArray(), AddSettingsDto::rules());
        return $this->settingsService->add($addSettingsDto->toArray());
    }
}