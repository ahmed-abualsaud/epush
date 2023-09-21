<?php

namespace Epush\Core\MessageLanguage\Domain\UseCase;

use Epush\Core\MessageLanguage\Domain\DTO\AddMessageLanguageDto;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageLanguageUseCase
{
    public function __construct(

        private MessageLanguageServiceContract $messageLanguageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageLanguageDto $addMessageLanguageDto): array
    {
        $this->validationService->validate($addMessageLanguageDto->toArray(), AddMessageLanguageDto::rules());
        return $this->messageLanguageService->add($addMessageLanguageDto->toArray());
    }
}