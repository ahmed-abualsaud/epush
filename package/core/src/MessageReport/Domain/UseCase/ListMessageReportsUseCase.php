<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\ListMessageReportsDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageReportsUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageReportsDto $listMessageReportsDto): array
    {
        $this->validationService->validate($listMessageReportsDto->toArray(), ListMessageReportsDto::rules());
        return $this->messageReportService->list($listMessageReportsDto->getPageSize());
    }
}