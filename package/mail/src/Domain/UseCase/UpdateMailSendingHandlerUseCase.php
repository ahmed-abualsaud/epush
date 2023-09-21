<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\Domain\DTO\MailSendingHandlerDto;
use Epush\Mail\Domain\DTO\UpdateMailSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMailSendingHandlerUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailSendingHandlerDto $mailSendingHandlerDto, UpdateMailSendingHandlerDto $updateMailSendingHandlerDto): array
    {
        $this->validationService->validate($mailSendingHandlerDto->toArray(), MailSendingHandlerDto::rules());
        $this->validationService->validate($updateMailSendingHandlerDto->toArray(), UpdateMailSendingHandlerDto::rules());
        return $this->mailService->updateMailSendingHandler($mailSendingHandlerDto->getMailSendingHandlerID(), $updateMailSendingHandlerDto->toArray());
    }
}