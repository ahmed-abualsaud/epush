<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\MailSendingHandlerDto;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMailSendingHandlerUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailSendingHandlerDto $mailSendingHandlerDto): bool
    {
        $this->validationService->validate($mailSendingHandlerDto->toArray(), MailSendingHandlerDto::rules());
        return $this->mailService->deleteMailSendingHandler($mailSendingHandlerDto->getMailSendingHandlerID());
    }
}