<?php

namespace Epush\Core\MessageLanguage\Domain\UseCase;

use Epush\Core\MessageLanguage\Domain\DTO\SearchMessageLanguageDto;
use Epush\Core\MessageLanguage\App\Contract\MessageLanguageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageLanguageUseCase
{
    public function __construct(

        private MessageLanguageServiceContract $messageLanguageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageLanguageDto $searchMessageLanguageDto): array
    {
        $this->validationService->validate($searchMessageLanguageDto->toArray(), SearchMessageLanguageDto::rules());
        return $this->messageLanguageService->searchColumn(
            $searchMessageLanguageDto->getSearchColumn(),
            $searchMessageLanguageDto->getSearchValue(),
            $searchMessageLanguageDto->getPageSize()
        );
    }
}