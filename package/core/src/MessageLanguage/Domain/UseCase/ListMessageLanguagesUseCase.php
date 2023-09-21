<?php

namespace Epush\Core\MessageLanguage\Domain\UseCase;

use Epush\Core\MessageLanguage\Domain\DTO\ListMessageLanguagesDto;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageLanguagesUseCase
{
    public function __construct(

        private MessageLanguageServiceContract $messageLanguageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageLanguagesDto $listMessageLanguagesDto): array
    {
        $this->validationService->validate($listMessageLanguagesDto->toArray(), ListMessageLanguagesDto::rules());
        return $this->messageLanguageService->list($listMessageLanguagesDto->getPageSize());
    }
}