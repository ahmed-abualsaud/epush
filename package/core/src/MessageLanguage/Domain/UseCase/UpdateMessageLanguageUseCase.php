<?php

namespace Epush\Core\MessageLanguage\Domain\UseCase;

use Epush\Core\MessageLanguage\Domain\DTO\MessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\UpdateMessageLanguageDto;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageLanguageUseCase
{
    public function __construct(

        private MessageLanguageServiceContract $messageLanguageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageLanguageDto $messageLanguageDto, UpdateMessageLanguageDto $updateMessageLanguageDto): array
    {
        $this->validationService->validate($messageLanguageDto->toArray(), MessageLanguageDto::rules());
        $this->validationService->validate($updateMessageLanguageDto->toArray(), UpdateMessageLanguageDto::rules());
        return $this->messageLanguageService->update($messageLanguageDto->getMessageLanguageID(), $updateMessageLanguageDto->toArray());
    }
}