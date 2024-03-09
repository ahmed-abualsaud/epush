<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\BulkAddMessageDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class BulkAddMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BulkAddMessageDto $bulkAddMessageDto): array
    {
        // $this->validationService->validate($bulkAddMessageDto->toArray(), BulkAddMessageDto::rules());
        return $this->messageService->bulkAdd(
            $bulkAddMessageDto->getUserID(),
            $bulkAddMessageDto->getMessage(), 
            $bulkAddMessageDto->getMessageGroupRecipients(),
            $bulkAddMessageDto->getSegments()
        );
    }
}