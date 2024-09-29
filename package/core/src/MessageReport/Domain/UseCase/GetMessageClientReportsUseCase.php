<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\GetMessageClientReportsDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageClientReportsUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(GetMessageClientReportsDto $getMessageClientReportsDto): array
    {
        $this->validationService->validate($getMessageClientReportsDto->toArray(), GetMessageClientReportsDto::rules());
        return $this->messageReportService->getMessageClientReports($getMessageClientReportsDto->getUserID());
    }
}