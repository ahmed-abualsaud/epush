<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class DeleteFileMicroprocess implements MicroprocessContract
{
    public function __construct(

        private FileServiceContract $fileService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$fileName, $folder] = $data;
        return $this->fileService->deleteLocalFile($fileName, $folder);
    }
}