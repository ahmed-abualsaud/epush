<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\MessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\UpdateMessageReportDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageReportUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageReportDto $messageReportDto, UpdateMessageReportDto $updateMessageReportDto): array
    {
        $this->validationService->validate($messageReportDto->toArray(), MessageReportDto::rules());
        $this->validationService->validate($updateMessageReportDto->toArray(), UpdateMessageReportDto::rules());
        return $this->messageReportService->update($messageReportDto->getMessageID(), $updateMessageReportDto->toArray());
    }
}