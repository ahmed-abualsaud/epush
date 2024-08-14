<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\MessageReportDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageReportUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageReportDto $messageReportDto): array
    {
        $this->validationService->validate($messageReportDto->toArray(), MessageReportDto::rules());
        return $this->messageReportService->get($messageReportDto->getMessageID());
    }
}