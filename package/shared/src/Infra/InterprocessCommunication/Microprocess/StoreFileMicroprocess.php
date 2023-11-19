<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class StoreFileMicroprocess implements MicroprocessContract
{
    public function __construct(

        private FileServiceContract $fileService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$fileAttributeName, $folder] = $data;
        $fileName = count($data) >= 3 ? $data[2] : null;

        return $this->fileService->localStore($fileAttributeName, $folder, $fileName);
    }
}