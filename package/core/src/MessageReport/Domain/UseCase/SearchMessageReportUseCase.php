<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\SearchMessageReportDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageReportUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageReportDto $searchMessageReportDto): array
    {
        $this->validationService->validate($searchMessageReportDto->toArray(), SearchMessageReportDto::rules());
        return $this->messageReportService->searchColumn(
            $searchMessageReportDto->getSearchColumn(),
            $searchMessageReportDto->getSearchValue(),
            $searchMessageReportDto->getPageSize()
        );
    }
}