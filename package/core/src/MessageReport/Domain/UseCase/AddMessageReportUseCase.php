<?php

namespace Epush\Core\MessageReport\Domain\UseCase;

use Epush\Core\MessageReport\Domain\DTO\AddMessageReportDto;
use Epush\Core\MessageReport\App\Contract\MessageReportServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageReportUseCase
{
    public function __construct(

        private MessageReportServiceContract $messageReportService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageReportDto $addMessageReportDto): array
    {
        $this->validationService->validate($addMessageReportDto->toArray(), AddMessageReportDto::rules());
        return $this->messageReportService->add($addMessageReportDto->toArray());
    }
}