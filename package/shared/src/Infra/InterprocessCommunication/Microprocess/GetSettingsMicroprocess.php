<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Settings\App\Contract\SettingsServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class GetSettingsMicroprocess implements MicroprocessContract
{
    public function __construct(

        private SettingsServiceContract $settingsService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$settingsName] = $data;

        return $this->settingsService->getByName($settingsName);
    }
}