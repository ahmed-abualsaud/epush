<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\AddFileDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddFileUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddFileDto $addFileDto): array
    {
        $this->validationService->validate($addFileDto->toArray(), AddFileDto::rules());
        return $this->fileService->add($addFileDto->toArray());
    }
}