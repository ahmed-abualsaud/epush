<?php

namespace Epush\Core\MessageLanguage\Domain\UseCase;

use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Core\MessageLanguage\Domain\DTO\MessageLanguageDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageLanguageUseCase
{
    public function __construct(

        private MessageLanguageServiceContract $messageLanguageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageLanguageDto $messageLanguageDto): bool
    {
        $this->validationService->validate($messageLanguageDto->toArray(), MessageLanguageDto::rules());
        return $this->messageLanguageService->delete($messageLanguageDto->getMessageLanguageID());
    }
}