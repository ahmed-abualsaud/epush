<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Core\MessageReport\Domain\DTO\MessageReportDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageReportUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageReportDto $messageReportDto): bool
    {
        $this->validationService->validate($messageReportDto->toArray(), MessageReportDto::rules());
        return $this->messageReportService->delete($messageReportDto->getMessageID());
    }
}